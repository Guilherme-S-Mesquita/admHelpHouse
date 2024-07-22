@extends('layouts.main')

@section('title', 'CadastroServico')

@section('contentAdmin')
<div class="main p-3">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Gerenciar Serviços</h2>
            <a href="/criarServico" class="btn btn-primary mb-3">Adicionar Novo Serviço</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preços</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicos as $servico)
                    <tr>
                        <td scope="row">{{ $servico->idServicos }}</td>
                        <td>{{ $servico->nomeServicos }}</td>
                        <td>{{ $servico->descServicos }}</td>
                        <td>{{ $servico->precoServicos }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
