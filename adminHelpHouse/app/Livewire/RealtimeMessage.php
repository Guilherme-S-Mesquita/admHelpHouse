<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\User;
use Livewire\Component;
use App\Models\ChatRoom;
use App\Events\SendRealtimeMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class RealtimeMessage extends Component
{
    use LivewireAlert; // Usa a trait LivewireAlert para exibir notificações (alertas) na interface.

    // Propriedades que armazenam o estado da aplicação.
    public string $roomId;          // ID da sala de chat.
    public string $message = '';    // Armazena a mensagem digitada pelo usuário.
    public string $status;          // Armazena o status atual do usuário (Online ou Offline).
    public string $friendStatus;    // Armazena o status do amigo (Online ou Offline).
    public string $friendName;      // Armazena o nome do amigo na sala de chat.


    public $messages = [];


    // Construtor que inicializa as variáveis de status como Offline.

    public function __construct()
    {
        $this->status = 'Offline';        // O status do usuário começa como Offline.
        $this->friendStatus = 'Offline';  // O status do amigo também começa como Offline.
    }

    // Método para registrar os eventos que o componente vai ouvir.
    public function getListeners()
    {
        return [
            // Ouvindo o evento de mensagem em tempo real, para receber mensagens na sala de chat.
            "echo-presence:channel.{$this->roomId},SendRealtimeMessage" => 'handleSendMessage',

            // Ouvindo o evento 'here' que indica os usuários presentes na sala de chat.
            "echo-presence:channel.{$this->roomId},here" => 'handleHere',

            // Ouvindo o evento de quando um novo usuário entra na sala.
            "echo-presence:channel.{$this->roomId},joining" => 'handleJoining',

            // Ouvindo o evento de quando um usuário sai da sala.
            "echo-presence:channel.{$this->roomId},leaving" => 'handleLeaving',
        ];
    }

    // Método para disparar o evento de enviar mensagem.
    public function triggerEvent(): void
    {
        if ($this->message != '') {
            $userId = auth()->user()->id;

            // Cria a mensagem no banco de dados
            $newMessage = Chat::create([
                'chat_room_id' => $this->roomId,
                'user_id' => $userId,
                'message' => $this->message,
            ]);

            // Transmite apenas o ID da mensagem criada
            event(new SendRealtimeMessage($newMessage->id, $this->roomId));

            // Limpa o campo de mensagem
            $this->message = '';
        } else {
            $this->alert('error', 'Fill the message');
        }
    }

    // Método que lida com o recebimento de mensagens em tempo real.
    public function handleSendMessage($event): void
    {
        // Busca a mensagem pelo ID enviado no evento
        $newMessage = Chat::with('user')->find($event['messageId']);

        if ($newMessage) {
            // Atualiza o status da mensagem para "lida"
            $newMessage->update(['is_read' => true]);
        }

        // Verifica se a mensagem foi encontrada
        if ($newMessage) {
            // Atualiza o array de mensagens com a nova mensagem
            $this->messages[] = $newMessage;

            // Exibe um alerta com o conteúdo da nova mensagem
            $this->alert('success', 'New message: ' . $newMessage->message);
        } else {
            // Caso a mensagem não seja encontrada, exibe um alerta de erro
            $this->alert('error', 'Message not found');
        }
    }




    // Método que lida com o evento 'here', que indica os usuários presentes na sala de chat.
    public function handleHere($event): void
    {
        // Percorre todos os usuários presentes na sala.
        foreach ($event as $user) {
            // Se o ID do usuário não for o mesmo que o usuário autenticado...
            if ($user['id'] != auth()->user()->id) {
                // Define o status do amigo como Online e armazena seu nome.
                $this->friendStatus = 'Online';
                $this->friendName = $user['name'];
            }
        }

        // Define o status do próprio usuário como Online.
        $this->status = 'Online';
    }

    // Método que lida com o evento de quando um usuário entra na sala de chat.
    public function handleJoining($event): void
    {
        // Define o status do amigo como Online e armazena seu nome.
        $this->friendStatus = 'Online';
        $this->friendName = $event['name'];
    }

    // Método que lida com o evento de quando um usuário sai da sala de chat.
    public function handleLeaving($event): void
    {
        // Define o status do amigo como Offline e armazena seu nome.
        $this->friendStatus = 'Offline';
        $this->friendName = $event['name'];
    }

    // Método para deslogar o usuário da sessão.
    public function logout()
    {
        // Executa o logout do usuário autenticado.
        Auth::logout();

        // Limpa todos os dados da sessão.
        Session::flush();

        // Redireciona o usuário para a rota de login.
        $this->redirectRoute('login');
    }
    public function mount ($roomId){
        $this->roomId = $roomId;

        $this->messages = Chat::where('chat_room_id', $this->roomId)
        ->with('user')
        ->orderBy('created_at', 'asc') // Ordena as mensagens pela data de criação
        ->get();
    }

    // Método para voltar à lista de contatos.
    public function back()
    {
        // Redireciona o usuário para a rota de contatos.
        $this->redirectRoute('contact');
    }

    // Método para renderizar a view do componente.
    public function render()
    {
        // Retorna a view do Livewire 'realtime-message'.
        return view('livewire.realtime-message', ['messages' => $this->messages]);

    }
}
