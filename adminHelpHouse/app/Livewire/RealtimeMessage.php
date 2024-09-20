<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\ChatRoom;
use App\Models\Contratante;
use App\Models\Profissional;
use Livewire\Component;
use App\Events\SendRealTimeMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RealtimeMessage extends Component
{
    use LivewireAlert;

    public string $roomId;
    public string $message = '';
    public string $status = 'Offline';
    public string $friendStatus = 'Offline';
    public string $friendName = '';
    public $messages = [];

    public function __construct()
    {
        // O status do usuário começa como Offline
    }

    public function getListeners()
    {
        return [
            "echo-presence:channel.{$this->roomId},SendRealTimeMessage" => 'handleSendMessage',
            "echo-presence:channel.{$this->roomId},here" => 'handleHere',
            "echo-presence:channel.{$this->roomId},joining" => 'handleJoining',
            "echo-presence:channel.{$this->roomId},leaving" => 'handleLeaving',
        ];
    }

    public function triggerEvent(): void
    {
        if ($this->message != '') {
            $userId = auth()->user()->id;

            // Identifica o tipo de usuário
            $userType = auth()->user() instanceof Contratante ? 'Contratante' : 'Profissional';

            // Cria a mensagem no banco de dados
            $newMessage = Chat::create([
                'chat_room_id' => $this->roomId,
                'user_id' => $userId,
                'message' => $this->message,
                'user_type' => $userType, // Adicione esta linha se quiser armazenar o tipo de usuário
            ]);

            // Dispara o evento para enviar a mensagem em tempo real
            event(new SendRealTimeMessage($newMessage->id, $this->roomId));

            // Limpa o campo de mensagem
            $this->message = '';
        } else {
            $this->alert('error', 'Fill the message');
        }
    }


    public function handleSendMessage($event): void
    {
        $newMessage = Chat::with('user')->find($event['messageId']);

        if ($newMessage) {
            $newMessage->update(['is_read' => true]);
            $this->messages[] = $newMessage;
            $this->alert('success', 'New message: ' . $newMessage->message);
        } else {
            $this->alert('error', 'Message not found');
        }
    }

    public function handleHere($event): void
    {
        foreach ($event as $user) {
            if ($user['id'] != auth()->user()->id) {
                $this->friendStatus = 'Online';
                $this->friendName = $user['name'];
            }
        }
        $this->status = 'Online';
    }

    public function handleJoining($event): void
    {
        $this->friendStatus = 'Online';
        $this->friendName = $event['name'];
    }

    public function handleLeaving($event): void
    {
        $this->friendStatus = 'Offline';
        $this->friendName = $event['name'];
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        $this->redirectRoute('login');
    }

    public function mount($roomId)
    {
        $this->roomId = $roomId;

        $this->messages = Chat::where('chat_room_id', $this->roomId)
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function back()
    {
        $this->redirectRoute('contact');
    }

    public function render()
    {
        return view('livewire.realtime-message', ['messages' => $this->messages]);
    }
}
