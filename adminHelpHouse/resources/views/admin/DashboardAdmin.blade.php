@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')

<div class="main p-3">
<div class="backdrop">

{{-- Aqui ele busca o usuario logado -> name para apenas pegar o nome --}}
<div class="inicio">
<div class="header mb-4 ">
    <h3>Olá, <span style="color: #ff6347;">{{$user->name}}</span></h3>
</div>
</div>


    <div class="title">
        <p class="titleDashboard">Dashboard</p>
    </div>

    <div class="pai">
        <div class="retangulo"></div>
        <div class="retangulo"></div>
        <div class="retangulo"></div>
        <div class="retangulo"></div>
    </div>

    <hr>

    <div class="principal">
        <div class="partes">
            <h2 style="color: #004AAD">Serviços mais procurados</h2>
            <div class="grafico">
                <canvas id="chart" style="width: 370px; height: 370px;">
                <script>
                    const ctx = document.getElementById('chart');

                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                        labels: ['Montador', 'Pedreiro', 'Eletricista', 'Encanador'],
                        datasets: [{
                            label: '# of Votes',
                            data: [40, 10, 25, 35],
                            backgroundColor: [
                                    '#FFA500', // Laranja para Pedreiro
                                    '#3DAEDB', // Azul para Eletricista
                                    '#6BCFCF', // Azul claro para Encanador
                                    '#2D5186'  // Azul escuro para Montador
                                ],
                                borderColor: [
                                    '#FFFFFF',
                                    '#FFFFFF',
                                    '#FFFFFF',
                                    '#FFFFFF'
                                ],
                                borderWidth: 0
                            }]
                        
                        },
                       
                    });
                    </script>
                </canvas>

            </div>
            <div class="servicos">
                <div class="oncinha">
                    <h2>Serviços <span style="color:#f1c100 ">Solicitados</span></h2>
                    <h2 class="numero" style="color:#f1c100">10</h2>
                </div>
                <div class="oncinha">
                    <h2>Serviços <span style="color:#009245">Concluidos</span> </h2>
                    <h2 class="numero" style="color:#009245">24</h2>
                </div>
            </div>
        </div>


        
        <div class="partes">
        <h2 style="color: #004AAD">Últimas perguntas</h2>
                <div class="perguntas"></div>
        </div>
        <div class="partes1">
            <h2 style="color: #004AAD">Crescimento de usúarios</h2>
            <div class="grafico2">
                <canvas id="chart2" style="width: 370px; height: 370px;">
                                    
                <script>
                const ctx = document.getElementById('chart2');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                        beginAtZero: true
                        }
                    }
                    }
                });
                </script>
                
                                </canvas>
            </div>
            <div class="botoes"></div>
        </div>
    </div>


<!-- 
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
                <div class="numPerguntas">
                        <p class="num">84</p>
                        <div class="textPerguntas">
                            <p class="perguntas">Perguntas</p>
                            <p class="emAberto">em aberto</p>

                        </div>
                </div>
                <div class="infoAdmin">
                    <div class="solicitacoes">
                        <p class="num2">+23</p>
                        <h2 class="ig">Solicitações</h2>
                        <h2 class="ryan">em aberto</h2>
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

            <a href="/infosgerais">
                <div class="info2">
                <div class="icon"><i class="material-icons">public</i></div>
                    <div class="chupapal"><h2 class="chupapal">Informações</h2></div>
                </div>
            </a>

            </div>

            <div class="vish">
                <div class="atendimentos">
                    <a href=""></a>
                <i class="material-icons">access_time</i>
                    <h2 class="amarelo">Atendimentos</h2>
                    <h2 class="preto">em aberto</h2>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>


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
