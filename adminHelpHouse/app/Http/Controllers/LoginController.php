<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
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
            'password.required' => 'campod e senha e obrigatório'   

        ]);
    
        // Tentativa de autenticação
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard')); // Redireciona para a página principal ou desejada
        } else {
            return redirect()->route('login.index')->with('err', 'Email ou senha inválido');
        }
    }
    public function destroy()
    {
        Auth::logout();
        return redirect()->view('logout'); // Redireciona para a página de login após logout
    }
}

