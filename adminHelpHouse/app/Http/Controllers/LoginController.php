<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Login;

class loginController extends Controller
{
    public function index()
    {
        return view('login');
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

        // Tentativa de autenticação
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard'); // Redireciona para a página principal ou desejada
        }else {
            return redirect()->route('login.index')->with('err', 'Email ou senha inválido');
        }
    }
    // public function destroy()
    // {

    //     return view('dashboard'); // Redireciona para a página de login após logout
    // }
}

