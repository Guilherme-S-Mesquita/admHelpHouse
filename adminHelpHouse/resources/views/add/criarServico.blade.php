@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')


<div class="container">
    <h1>Criar Serviço</h1>

    @if(session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    <form action="{{ route('inserir.servico') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nomeServicos">Nome do Serviço:</label>
            <input type="text" class="form-control" id="nomeServicos" name="nomeServicos" required>
        </div>
        <div class="form-group">
            <label for="categoriaServicos">Categoria:</label>
            <input type="text" class="form-control" id="categoriaServicos" name="categoriaServicos" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descServicos" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
