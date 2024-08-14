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

<!-- Inclua o script do Chart.js -->
<div class="chart">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('myChart').getContext('2d');
    const data = {
        labels: ['January', 'February', 'March'],
        datasets: [
            {
                label: 'Contratantes',
                data: [65, 59, 80, 81],
                backgroundColor: '#6CE5E8',
                borderColor: '#6CE5E8',
                borderWidth: 1
            },
            {
                label: 'Profissionais',
                data: [28, 48, 40,],
                backgroundColor: '#41B8D5',
                borderColor: '#41B8D5',
                borderWidth: 1
            }
        ]
    };

    new Chart(ctx, {
        type: 'bar', // ou 'line', 'pie', etc.
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
</div>





</div>
</div>

@endsection