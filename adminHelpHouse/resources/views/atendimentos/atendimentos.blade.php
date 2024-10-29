@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')

<div class="main p-3" style="height: 100vh; ">

    <div class="header mb-4 "    style="margin-left:3vh;">
    <h1 style="color: #004aac;">Atendimentos</h1>
    
        <h2  style="color: black;">Denúncias</h2>
    </div>

    <div class="container-fluid h-85 d-flex justify-content-center align-items-center"   style= "margin-left:2vh;">
        <div class="row w-100 d-flex justify-content-around">
            
            <div class="col-md-4 mb-4"> 
                <a href="{{route('users.admins')}}" class="card-link">
                    <div class="card">
                        <div class="card-body">
                            <img src="/img/engrenagemAdm.png" alt="Ícone de Administradores">
                            <h3   style="color:#009245;"  class="card-title">Em aberto</h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="{{route('users.clientes')}}" class="card-link">
                    <div class="card">
                        <div class="card-body">
                            <img src="/img/usuariosClientes.png" alt="Ícone de Clientes">
                            <h3  style="color:#ffde59;" class="card-title">Em andamento</h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="#" class="card-link">
                    <div class="card">
                        <div class="card-body">
                            <img src="/img/profissionais.png" alt="Ícone de Profissionais">
                            <h3   style="color:#ff3131;" class="card-title">Encerradas</h3>
                        </div>
                    </div>
                </a>
            </div>
            
        </div>
    </div>
</div>


<style> 


</style>

@endsection
