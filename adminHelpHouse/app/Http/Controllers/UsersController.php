<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profissional;
use App\Models\Contratante;
use App\Models\Pedido;


class UsersController extends Controller
{

    public function index(){

        $users = User::all();

        $contratantes = Contratante::all();
        $contratados = Profissional::all();



        if (!auth()->check()) {
            return redirect()->route('login'); // Redireciona para a página de login
        }

        $user = auth()->user();
        return view('users.index', compact('user' ,'users', 'contratantes', 'contratados'));
    }

    public function userAdm(){


        $user = auth()->user();

        return view('users.admins'  ,compact('user', ));

    }
    public function edit($id){

        $user = User::findOrFail($id);
// o users. é para entrar na pasta, ja o editAdmin é o nome da view
        return view('users.editAdmin', compact('user'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cpf' => 'required|string|max:14',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->cpf = $request->cpf;
            $user->save();

            return redirect()->route('users.admins')->with('msg', 'Serviço atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao atualizar o usuário: ' . $e->getMessage());
        }
    }

    public function delete($id){


        User::findOrFail($id)->delete();

        return redirect()->route('users.admins')->with('msg', 'Serviço excluido com sucesso!');
    }


    public function clientes(){
    // users é o caminho da pasta, e os clientes é o nome da pagina
        return view('users.clientes');
    }





}
