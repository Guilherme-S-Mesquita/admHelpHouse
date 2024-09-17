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

    public function chat($contactId)
    {
        //Aqui ele procura uma sala de chat existente com base nos IDs
        $findRoom = ChatRoom::where('participant',  auth()->user()->id . ':' . $contactId)
            ->orWhere('participant',   $contactId . ':' . auth()->user()->id)
            ->first();

        if (!$findRoom) {
            // Se não encontrar uma sala, cria uma nova
            $findRoom = ChatRoom::create([
                'participant' => auth()->user()->id . ':' . $contactId
            ]);
        }

        $this->redirectRoute('message', $findRoom->id);
    }
    public function render()
    {
        return view('livewire.contact');
    }
}
