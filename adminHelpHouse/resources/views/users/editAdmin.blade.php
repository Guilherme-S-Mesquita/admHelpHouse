@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')

<link rel="stylesheet" href="{{ asset('css/editAdmin.css') }}">

<div class="main p-3">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-" id="adm">Administrador</h2>
            <form action="{{ route('update.admins', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="branco">
                <div class="form-group col-md-2" id="inputs">
                    <label for="nomeServicos" class="dados">Nome do administrador:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>
                <div class="form-group col-md-2" id="inputs">
                    <label for="descServicos">Descrição:</label>
                    <textarea class="form-control" id="email" name="email" required>{{ $user->email}}</textarea>
                </div>
                <div class="form-group col-md-2" id="inputs">
                    <label for="precoServicos">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $user->cpf }}" required>

                    
                <button type="submit" class="btn btn-primary" id="mudarFoto">Mudar foto</button>

                </div>
                </div>
                <button type="submit" class="btn btn-danger" id="botaoRed">Excluir Usuário</button>
            </form>
        </div>
    </div>
</div>
@endsection



