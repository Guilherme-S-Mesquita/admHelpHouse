@extends('layouts.main')

@section('title', 'Criando Servico')

@section('contentAdmin')
<div class="main p-3">
    <div class="row"    style="margin-left:8vh";>
        <div class="col-md-12">

            <h2 class="mb-4">Gerenciar Serviços</h2>
            <a href="/criarServico" class="btn btn-primary mb-3">Adicionar Novo Serviço</a>
            <table class="table"    style="margin-top10%";>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Descrição</th>
                        <th>editar</th>
                        <th>Excluir</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicos as $servico)
                    <tr>
                        <td scope="row">{{ $servico->idServicos }}</td>
                        <td>{{ $servico->nomeServicos }}</td>
                        <td>{{ $servico->categoriaServicos }}</td>
                        <td>{{ $servico->descServicos }}</td>
                        <td>
                             <!-- Botões de editar -->
                    <a href="{{ route('edit.servico', $servico->idServicos) }}" class="btn btn-info edit-btn">
                        <ion-icon name="create-outline"></ion-icon> Editar
                    </a>
                    </td>
                    <td>
                    <form action="{{ route('delete.servico', $servico->idServicos) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">
                            <ion-icon name="trash-outline"></ion-icon> Deletar
                        </button>
                    </form>
                    </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

</div>
@endsection
