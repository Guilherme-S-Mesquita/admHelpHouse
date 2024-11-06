@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')

<div class="main p-3" style="height: 100vh;">
<link rel="stylesheet" href="{{ asset('css/usuários.css') }}">
    <div class="header mb-4 "    style="margin-left:3vh;">
        <h1>Olá,<span style="color: #ff6347;">{{$user->name}}</span></h1>
        <h2>Usuários</h2>
    </div>

    <div class="container-fluid h-85 d-flex justify-content-center align-items-center"   style= "margin-left:2vh;">
        <div class="row w-100 d-flex justify-content-around">
          
            <div class="col-md-4 mb-4">
                <a href="{{route('users.clientes')}}" class="card-link">
                    <div class="card3">
                        <div class="card-body">
                            <img src="/img/userPerfil.png" alt="Ícone de Clientes">
                            <h3 class="card-title">Profissionais</h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="#" class="card-link">
                    <div class="card2">
                        <div class="card-body2">
                            <img src="/img/userPerfil.png" alt="Ícone de Profissionais">
                            <h3 class="card-title2">Clientes</h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="{{route('users.admins')}}" class="card-link">
                    <div class="card">
                        <div class="card-body3">
                            <img src="/img/userPerfil.png" alt="Ícone de Administradores">
                            <h3 class="card-title3">Administradores</h3>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
    <div class="partes">
    </div>
    <div class="partes2">
    </div>
</div>


<style> 

    

</style>

@endsection




