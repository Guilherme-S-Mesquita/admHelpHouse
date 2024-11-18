@extends('layouts.main')

@section('title', 'Editar Serviço')

@section('contentAdmin')
<div class="main p-8">

    <div class="row">
        <div class="col-md-10" style="margin-left:160px; margin-top:100px">
            <h2 class="mb-8" style="font-weight:500; font-size:48px">Editar Serviço</h2>
            <form action="{{ route('update.servico', $servico->idServicos) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group" style="width:1250px; height:400px; background-color:rgb(243, 240, 240); border-radius: 25px; margin-left:75px; margin-top:45px">
                    <label for="nomeServicos" style="font-weight:700; font-size:24px; margin-left:95px; margin-top:55px; padding:7px;">Nome do Serviço:</label>
                    <input type="text" class="form-control" id="nomeServicos" style="font-weight:500; font-size:20px; width:800px; margin-left:225px;"  name="nomeServicos" value="{{ old('nomeServicos', $servico->nomeServicos) }}" required>


                    <label for="descServicos" style="font-weight:700; font-size:24px; margin-left:95px; margin-top:45px;padding:7px;">Descrição:</label>
                    <textarea class="form-control" id="descServicos" style="font-weight:500; font-size:20px; width:800px; margin-left:225px;" name="descServicos" required>{{ old('descServicos', $servico->descServicos) }}</textarea>

                <button type="submit" class="btn" style="background-color:#004AAC; color:#fff; margin-top:30px; margin-left:520px">Atualizar Serviço</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
