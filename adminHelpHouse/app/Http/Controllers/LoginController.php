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

    public function store(Request $request){
        var_dump('form');
    }

    public function destroy(){
        var_dump('logout');
    }
}
