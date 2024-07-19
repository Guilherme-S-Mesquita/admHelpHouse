<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function auth (Request $request){

        $credenciais = $request->validate([
            'email' => ['required' ,'email'],
            'passoword' => ['required'],
        ]);


        if(Auth::attempt($credenciais)){
            $request->session()->regenerate();
            return redirect()->intended('admin/DasboardAdmin');
        }else{
            return redirect()->back()->with('erro',  'Email ou senha inválida');
        }


    }
}
