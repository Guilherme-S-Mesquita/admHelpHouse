<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class loginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function register(){

        return view ('register');
    }
    public function processoDeRegistro(Request $request){
         // a variavel de validações define algumas regras
        //o make por exemplo é para aceitar as regras descritas a baixo   'email'=>'required|email|unique:users', por exemplo

        $validator = Validator::make($request->all(),[
            'email'=>'required|email|unique:users',
            'password'=> 'required|confirmed'

        ]);
        // verifica se atende as regras e passa os dados como verdadeiro
        if($validator->passes()){

            $user= new User();
            $user->name=$request->name;
            //para criar um hash seguro da senha fornecida pelo
            $user->email = $request->email;
            $user->password= Hash::make($request->password);
            $user->role = 'costumer';
            $user->save();

            return redirect()->route('login.index')->with('msg', 'Você foi cadastrado com sucesso');

        }else{
            return redirect()->route('login.register')
            ->withInput()  // Mantém os dados de entrada no formulário
            ->withErrors($validator);   // Passa os erros de validação para a visão
        }
    }

    // Método para autenticar o usuário
    public function authenticate(Request $request){
    // Valida as credenciais do usuário
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=> 'required'

        ]);
        if($validator->passes()){

        }else{
            return redirect()->route('login.index')
            ->withInput()
            ->withErrors($validator);
        }
    }

    public function store(Request $request)
    {


        // Validação dos dados
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],

        [
            'email.required' => 'campo de email e obrigatório',
            'email.email' => 'esse email e inválido',
            'password.required' => 'campo e senha e obrigatório'

        ]);



        // o Auth, tenta autenticar o Usuario e com isso ele cria uma nova sessão
        if (Auth::attempt($credentials)) {
            //Esta proxima linha é para garantir que a sessão seja unica
            $request->session()->regenerate();
            //depois de passar pelas especificações de segurança, ele te levara a tela de dashboard do admin
            return redirect()->intended(route('dashboard')); // Redireciona para a página principal ou desejada
        } else {
            return redirect()->route('login.index')->with('err', 'Email ou senha inválido');
        }
    }

    public function destroy (){

        Auth::logout();
        return redirect('/'); // Redireciona para a página de login após logout

    }
}

