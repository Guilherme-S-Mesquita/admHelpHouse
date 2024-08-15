@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')

<div class="main p-3">
<div class="backdrop">

{{-- Aqui ele busca o usuario logado -> name para apenas pegar o nome --}}
<div class="inicio">
<div class="header mb-4 ">
    <h1>Olá, <span style="color: #ff6347;">{{$user->name}}</span></h1>
</div>
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
                    <canvas id="myChart" width="750" height="280"></canvas>
                </div>
            </div>
        </div>
        <div class="infoAdmin2">
            <div class="segundaColuna">
<<<<<<< HEAD
                <div class="numPerguntas">
                        <p class="num">84</p>
=======
                <div class="numPerguntas" id="numPerguntas">
                        <p class="num" id="num">+84</p>
>>>>>>> 2302507f407ae6870866e3615bdcc6d49ddd543b
                        <div class="textPerguntas">
                            <p class="perguntas">Perguntas</p>
                            <p class="emAberto">em aberto</p>

                        </div>
                </div>
                <div class="infoAdmin">
                    <div class="solicitacoes">
<<<<<<< HEAD
                        <p class="num2">+23</p>
                        <h2 class="ig">Solicitações</h2>
                        <h2 class="ryan">em aberto</h2>
=======
                        <p class="num2" id="num2">+23</p>
                    <div class="textSolicitcao" id="textSolicitacao">
                        <h2 class="ig" id="ryan">Solicitações</h2>
                        <h2 class="ryan" id="ryan">em aberto</h2>
                    </div>
>>>>>>> 2302507f407ae6870866e3615bdcc6d49ddd543b
                    </div>
                </div>


            </div>
            <div class="segundaLinha">

            <div class="safadinha">

            <a href="../users/">
                <div class="info">
                    <div class="icon"><i class="material-icons">account_circle</i></div>
                    <div class="chupapal"><h2 class="chupapal">Usuários</h2></div>
                </div>
            </a>

            <a href="../financeiro/financei">
                <div class="info2">
                <div class="icon"><i class="material-icons">public</i></div>
                    <div class="chupapal"><h2 class="chupapal">Informações</h2></div>
                </div>
            </a>    

            </div>

            <div class="vish">
                <div class="atendimentos">
                <i class="material-icons">access_time</i>
                    <h2 class="amarelo">Atendimentos</h2>
                    <h2 class="preto">em aberto</h2>
                </div>
            </div>

            </div>
        </div>
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

@endsection
