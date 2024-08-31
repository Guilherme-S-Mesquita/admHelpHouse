@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')



<div class="container">
    <h1>Criar Serviço</h1>
    <form action="/adicionar" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome do Serviço:</label>
            <input type="text" class="form-control" id="nomeServicos" name="nomeServicos" required>
        </div>
        <div class="form-group">
            <label for="nome">Categoria</label>
            <input type="text" class="form-control" id="categoriaServicos" name="categoriaServicos" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descServicos" required></textarea>
        </div>
        <div class="form-group">
            <label for="preco">Preço:</label>
            <input type="text" class="form-control" id="preco" name="precoServicos" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
