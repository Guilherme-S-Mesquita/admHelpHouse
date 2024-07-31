@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')


<div class="main p-3">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Editar Administrador</h2>
            <form action="{{ route('update.admins', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nomeServicos">Nome do administrador:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label for="descServicos">Descrição:</label>
                    <textarea class="form-control" id="email" name="email" required>{{ $user->email}}</textarea>
                </div>
                <div class="form-group">
                    <label for="precoServicos">Preço:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $user->cpf }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar Serviço</button>
            </form>
        </div>
    </div>
</div>
@endsection
