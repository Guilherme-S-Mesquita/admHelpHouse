@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')

<link rel="stylesheet" href="{{ asset('css/criarServico.css') }}">


            <div class="title">
                <p class="titleservico">Criar serviço</p>
            </div>
           

    @if(session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    <div class="tudo">

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

        <button style="margin-top: 10px;" type="submit" class="btn btn-primary" >Salvar</button >
    </form>
    </div>

@endsection
