@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')
<div class="main p-3">

{{-- Aqui ele busca o usuario logado -> name para apenas pegar o nome --}}
<div class="header mb-4 ">
    <h1>Olá, <span style="color: #ff6347;">{{$user->name}}</span></h1>
</div>



    <div class="title">
        <p class="titleDashboard">Dashboard</p>
    </div>

    <div class="containerAdmin">
        <div class="infosAdmin">
            <div class="contratantes">
                <div class="contratantes-itens">
                    <ion-icon size="large" name="add-outline"></ion-icon>
                    <p class="numContratados">{{$acountContratantes}}</p>
                    <div class="novosContratantes">
                        <p class="novos">Novos</p>
                        <p class="contratantes">Contratantes</p>
                    </div>
                </div>
            </div>
            <div class="Profissionais">
                <div class="contratantes-itens">
                    <ion-icon size="large" name="add-outline"></ion-icon>
                    <p class="numProfissionais">{{$acountContratados}}</p>
                    <div class="novosProfissionais">
                        <p class="novosProf">Novos</p>
                        <p class="profissionais">Profissionais</p>
                    </div>
                </div>
            </div>
            <div class="osNaoSei">
                <div class="grafico">
                    <canvas id="myChart" width="600" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="infoAdmin2">
            <div class="segundaColuna">
                <div class="numPerguntas">
                        <p class="num">84</p>
                        <div class="textPerguntas">
                            <p class="perguntas">Perguntas</p>
                            <p class="emAberto">em aberto</p>

                        </div>
                </div>
                <div class="infoAdmin">

                </div>
            </div>
            <div class="segundaLinha">
                <div class="info"></div>
                <div class="info2"></div>
            </div>
        </div>
    </div>
</div>

<!-- Inclua o script do Chart.js -->
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
@endsection
