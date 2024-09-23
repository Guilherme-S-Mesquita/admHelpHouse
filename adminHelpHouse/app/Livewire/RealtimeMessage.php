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
            if (auth()->check()) {
                $userId = auth()->user()->id;
                $authenticatedUser = auth()->user();
                $userType = ''; // Inicializa com valor padrão
                $contratanteId = null; // Variável para armazenar ID do contratante
                $profissionalId = null; // Variável para armazenar ID do profissional

                // Verifica se o usuário autenticado é um contratante ou profissional
                if (Auth::guard('contratante')->check()) {
                    $userType = 'Contratante';
                    $contratanteId = Auth::guard('contratante')->user()->idContratante; // Pega o ID do contratante
                } elseif (Auth::guard('profissional')->check()) {
                    $userType = 'Profissional';
                    $profissionalId = Auth::guard('profissional')->user()->idContratado; // Pega o ID do profissional
                } elseif ($authenticatedUser instanceof User) {
                    $userType = 'User';
                }

                // Log para depuração (opcional)
                \Log::info('User Type: ' . $userType);
                \Log::info('Authenticated User Class: ' . get_class($authenticatedUser));

                // Cria a mensagem no banco de dados
                $newMessage = Chat::create([
                    'chat_room_id' => $this->roomId,
                    'user_id' => $userId,
                    'message' => $this->message,
                    'user_type' => $userType,
                    'idContratante' => $contratanteId,  // Armazena o ID do contratante se for um contratante
                    'idContratado' => $profissionalId,  // Armazena o ID do profissional se for um profissional
                ]);

                // Dispara o evento de mensagem em tempo real
                event(new SendRealTimeMessage($newMessage->id, $this->roomId));

                // Limpa o campo de mensagem após o envio
                $this->message = '';
            } else {
                // Log de erro caso o usuário não esteja autenticado
                \Log::error('User is not authenticated.');
            }
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
