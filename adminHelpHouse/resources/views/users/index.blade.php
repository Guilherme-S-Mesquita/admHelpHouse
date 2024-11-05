@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')

<div class="main p-3" style="height: 100vh;">

    <div class="header mb-4 "    style="margin-left:3vh;">
        <h1>Olá, <span style="color: #ff6347;">{{$user->name}}</span></h1>
        <h2>Controle de Usuários</h2>
    </div>


    <div class="tudo">
       
                <a href="{{route('users.admins')}}" >
                    <div class="icon"><i class="bi bi-person-fill-gear"></i></div>
                    <div class="titulo"><h2>Administradores</h2></div> 
                </a>
       
           
                <a href="{{route('users.clientes')}}">
                    <div class="icon"><i class="bi bi-people-fill"></i></div>
                    <div class="titulo"><h2>Clientes</h2></div> 
                </a>
        
      
                <a href="{{route('users.clientes')}}">
                    <div class="icon"><i class="bi bi-person-fill-up"></i></div>
                    <div class="titulo"><h2>Profissionais</h2></div> 
                </a>
        
    </div>
</div>


@endsection
