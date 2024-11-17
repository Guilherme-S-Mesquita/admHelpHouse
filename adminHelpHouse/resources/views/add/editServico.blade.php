@extends('layouts.main')

@section('title', 'Editar Serviço')

@section('contentAdmin')
<div class="main p-3">

    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Editar Serviço</h2>
            <form action="{{ route('update.servico', $servico->idServicos) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nomeServicos">Nome do Serviço:</label>
                    <input type="text" class="form-control" id="nomeServicos" name="nomeServicos" value="{{ old('nomeServicos', $servico->nomeServicos) }}" required>
                </div>

                <div class="form-group">
                    <label for="descServicos">Descrição:</label>
                    <textarea class="form-control" id="descServicos" name="descServicos" required>{{ old('descServicos', $servico->descServicos) }}</textarea>
                </div>



                <button type="submit" class="btn">Atualizar Serviço</button>
            </form>
        </div>
    </div>
</div>
@endsection
