<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function auth(Request $request)
    {


        $credenciais = $request->validate([
            'email' => 'required','email',
            'password' => 'required',
        ],

        [
            'email.required' => 'o email e um campo obrigatório',
            'email.email' => 'o email não valido',
            'password.required' => 'a senha e um campo obrigatório',
            'password.required' => 'a ssdovndfjkvnsf',

        ]


    );

        if (Auth::attempt($credenciais)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/DashboardAdmin');
        } else {
            return redirect()->back()->with('erro', 'Email ou senha inválida');
        }
    }
    public function logout (Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('##');
    }
}
