@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')

<div class="main p-3" style="height: 100vh;">
    <div class="header ">
        <h1>Olá, <span style="color: #ff6347;">Guilherme</span></h1>
        <h2>Controle de Usuários</h2>
    </div>

    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="row w-100 d-flex justify-content-around">
            <div class="col-md-4 mb-4">
                <a href="#" class="card-link">
                    <div class="card  ">
                        <div class="card-body ">
                                <img src="/img/engrenagemAdm.png" alt="">
                            <h3 class="card-title">Administradores</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="#" class="card-link">
                    <div class="card  ">
                        <div class="card-body  ">
                            <img src="/img/usuariosClientes.png" alt="">
                            <h3 class="card-title">Clientes</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="#" class="card-link">
                    <div class="card  ">
                        <div class="card-body ">

                            <h3 class="card-title">Profissionais</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
