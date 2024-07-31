@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')


<link rel="stylesheet" href="{{ asset('css/admins.css') }}">

<div class="main p-3">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Gerenciar administradores</h2>

            <table class="table">
                <thead>
                    <tr>

                        <th>Nome</th>
                        <th>Email</th>
                        <th>Nascimento</th>
                        <th>Cpf</th>
                        <th>Edit</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->date}}</td>
                        <td>{{$user->cpf}}</td>


                        <td>
                            <a href="{{ route('edit.admins', $user->id) }}" class="btn btn-info edit-btn">
                                <ion-icon name="create-outline"></ion-icon> Editar
                            </a>
                        </td>
                    </tr>
                   @endforeach
                </tbody>

@endsection
