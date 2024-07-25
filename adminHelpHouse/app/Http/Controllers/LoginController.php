<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class LoginController extends Controller
{

    public function index(){
        return view('login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required'
        ],
        [
            'email.required'=> 'Essa campo de email e obrigatório',
            'email.email'=> 'Essa campo de email tem que ser valido',
            'senha.required'=> 'Essa campo de senha e obrigatório'
        ]);

        $credentials = $request->only('email', 'senha');
        $autenticar = Auth::attempt($credentials);

        if (!$autenticar){
            return redirect()->route('login.index')->withErrors('err', 'autenticação invalida');
        }


    }
    public function destroy(){
        var_dump('logout');
    }
}
