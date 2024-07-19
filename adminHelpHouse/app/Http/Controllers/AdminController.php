<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller

{
    public function index(){
        return view('/admin/DashboardAdmin');
    }

    public function teste(Request $request){

        $testes = Admin::all();


        return view('/admin/teste', ['teste' => $testes]);
    }

}
