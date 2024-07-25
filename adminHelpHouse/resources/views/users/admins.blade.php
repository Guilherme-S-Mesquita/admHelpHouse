@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')


<link rel="stylesheet" href="{{ asset('css/admins.css') }}">

<div class="main p-3">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Gerenciar administradores</h2>
            <a href="/criarServico" class="btn btn-primary mb-3">Adicionar Novo Serviço</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>img</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Editar</th>
                        <th>Excluir</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">
                        <div class="imagemAdmin">
                            
                        </div>
                        </td>
                        <td>Guiilherme</td>
                        <td>guimesquita.1512@gmail.com</td>
                    </tr>
                </tbody>

@endsection
