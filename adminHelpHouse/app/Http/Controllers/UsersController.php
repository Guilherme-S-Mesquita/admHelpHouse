<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profissional;
use App\Http\Controllers\loginController;

class UsersController extends Controller
{

    public function index(){

    $user = auth()->user();


        return view('users.index',compact('user'));
    }
    public function userAdm(){
        $users = User::all();



        return view('users.admins'  ,compact('user', 'users'));

    }
    public function edit($id){

        $user = User::findOrFail($id);
// o users. é para entrar na pasta, ja o editAdmin é o nome da view
        return view('users.editAdmin', compact('user'));
    }
    public function update(Request $request, $id){

    // verifica se atende as regras e passa os dados como verdadeiro
   // Validação dos dados de entrada
    $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|max:255',
    'cpf' => 'required|string|max:14', // CPF em formato string
]);

        $user= User::findOrFail($id);
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->cpf   = $request->cpf;

        $user->save();

        return redirect()->route('users.admins')->with('msg', 'Serviço atualizado com sucesso!');

}
    public function delete($id){


        User::findOrFail($id)->delete();

        return redirect()->route('users.admins')->with('msg', 'Serviço excluido com sucesso!');
    }


    public function clientes(){
    // users é o caminho da pasta, e os clientes é o nome da pagina
        return view('users.clientes');
    }

    public function apiUserContratante(){

        $contratante =Profissional::all();

        return $contratante;
    }



}
