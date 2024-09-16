<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\ChatRoom;

class Contact extends Component
{
    public object $contacts;

    public function __construct()
    {
        //essa função busca a tabela users todos os usuarios não authenticados
        $this->contacts = User::where('id', '<>', auth()->user()->id)->get();
    }

    public function chat($contact)
    {
        //Aqui ele procura uma sala de chat existente
        $findRoom = ChatRoom::where('participant',  auth()->user()->id . ':' . $contact['id'])
        //no trecho abaixo após procurar a sala, ele verifica os participantes pelo id
            ->orWhere('participant',   $contact['id'] . ':' . auth()->user()->id)
            ->first();

        if (!$findRoom) {

            // Se ele for para uma sala de conversa sera redirecionado a conversa pelo id e tera o parametro de poder mandar a menssagem
            $findRoom = ChatRoom::create([
                'participant' => auth()->user()->id . ':' . $contact['id']
            ]);
        }

        $this->redirectRoute('message', $findRoom->id);
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
