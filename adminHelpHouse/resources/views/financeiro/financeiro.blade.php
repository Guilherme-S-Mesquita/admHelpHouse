@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')


<link rel="stylesheet" href="{{ asset('css/financeiro.css') }}">

<div class="main p-3">
<div class="backdrop">

        <div class="title">
            <p>Controle Financeiro</p>
        </div>
    
    
            <div class="primeiracoluna">
        
                <div class="receita">
                    <div>
                        <p class="nome">Movimentação</p>
                    </div>
                </div>

                <div class="mediaval">
                        <p class="nome">Média de valores dos serviços</p>
                </div>

                <div class="serviçosmes">
                        <p class="nome">Serviços realizados no mês de:</p>
                </div>
        </div>

</div>
</div>

@endsection