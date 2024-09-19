<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\ChatRoom;
use App\Models\Contratante;
use App\Models\Profissional;


class Contact extends Component
{
    public $users;
    public $profissionais;
    public $contratantes;

    public function mount()
    {
        // Carregar usuários da tabela 'users'
        $this->users = User::where('id', '<>', auth()->user()->id)->get();

        // Carregar profissionais da tabela 'tbcontratado' com a chave correta 'idContratado'
        $this->profissionais = Profissional::where('idContratado', '<>', auth()->user()->id)->get();

        // Carregar contratantes da tabela 'tbcontratante' com a chave correta 'idContratante'
        $this->contratantes = Contratante::where('idContratante', '<>', auth()->user()->id)->get();
    }

    public function chat($contactId, $contactType)
    {
        // Tipo de usuário atual
        $currentUserType = auth()->user()->getTable();
        $currentUserId = auth()->user()->id;

        // Identificar participantes do chat
        $currentParticipant = $currentUserType . ':' . $currentUserId;
        $otherParticipant = $contactType . ':' . $contactId;

        // Verificar se a sala de chat já existe
        $findRoom = ChatRoom::where('participant', $currentParticipant . ':' . $otherParticipant)
            ->orWhere('participant', $otherParticipant . ':' . $currentParticipant)
            ->first();

        // Se não encontrar, criar uma nova sala
        if (!$findRoom) {
            $findRoom = ChatRoom::create([
                'participant' => $currentParticipant . ':' . $otherParticipant,
            ]);
        }

        // Redirecionar para a sala de mensagens
        $this->redirectRoute('message', $findRoom->id);
    }

    public function render()
    {
        return view('livewire.contact', [
            'users' => $this->users,
            'profissionais' => $this->profissionais,
            'contratantes' => $this->contratantes
        ]);
    }
}

