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
        <div class="retanguloPro">
            <div class="vtnc"></div>
            <i class="icon fas fa-hard-hat"></i> <!-- Icon for 'Pro' -->
            <span class="labelP"> Pro |</span>
            <span class="countP">{{ $acountContratados ?? 18 }}</span> <!-- Example default value 18 -->
        </div>


        <div class="retanguloCli">

        <div class="mckevin">
            <i class="icon1 fas fa-user"></i> <!-- Icon for 'Client' -->
            <span class="labelC">⠀Cli</span>
        </div>
            <span class="uracan">|</span>
            <span class="countC">{{ $acountContratantes ?? 9 }}</span>
        </div>


        <div class="retanguloServ">
        <div class="mcig">
            <i class="icon fas fa-briefcase"></i> <!-- Icon for 'Services' -->
            <span class="labelS">⠀Serviços</span>
        </div>
            <span class="mccan">|</span>
            <span class="countS">{{ $serviceCount ?? 15 }}</span>
        </div>

        <div class="retanguloZona">
        <div class="mcgp">
            <i class="icon fas fa-map-marker-alt"></i> <!-- Icon for 'Zone' -->
            <span class="labelZ">⠀Zona</span>
        </div>
            <span class="mccan">|</span>
            <span class="countZ">{{ $zone ?? 'ZL' }}</span>
        </div>

    </div>

    <hr>

    <div class="principal">
        <div class="partes">
            <h2 style="color: #004AAD">Serviços mais procurados</h2>
            <div class="grafico">
                <canvas id="chart" style="width: 370px; height: 370px;">
                    <!DOCTYPE html>
                    <html lang="en">
                    <head class= "grafico">
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Gráfico de Pedidos por Serviço</title>
                        <!-- Adicione o Chart.js -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    </head>
                    <body>

                    <div class="chart-container" style="width: 50%; margin: auto;">
                        <canvas id="chart"></canvas>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const ctx = document.getElementById('chart').getContext('2d');

                            new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: {!! json_encode($labels) !!}, // Passando as labels dinâmicas
                                    datasets: [{
                                        label: 'Quantidade de Pedidos por Serviço',
                                        data: {!! json_encode($data) !!}, // Passando os dados dinâmicos
                                        backgroundColor: [
                                            '#FFA500', // Cor para Pedreiro
                                            '#3DAEDB', // Cor para Eletricista
                                            '#6BCFCF', // Cor para Encanador
                                            '#2D5186', // Cor para Montador
                                            '#FF6384', // Cor adicional para outro serviço
                                            '#36A2EB', // Cor adicional para outro serviço
                                            '#FFCE56'  // Cor adicional para outro serviço
                                        ],
                                        borderColor: [
                                            '#FFFFFF',
                                            '#FFFFFF',
                                            '#FFFFFF',
                                            '#FFFFFF',
                                            '#FFFFFF',
                                            '#FFFFFF',
                                            '#FFFFFF'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    let label = context.label || '';
                                                    let value = context.raw || 0;
                                                    let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                                    let percentage = ((value / total) * 100).toFixed(1);
                                                    return `${label}: ${value} (${percentage}%)`;
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        });
                    </script>

                    </body>
                    </html>

                </canvas>

            </div>
            <div class="servicos">
                <div class="oncinha">
                    <h3>Serviços <span style="color:#f1c100 ">Solicitados</span></h3>
                    <h3 class="numero" style="color:#f1c100">{{$contadorPedidos}}</h3>
                </div>
                <div class="oncinha">
                    <h3>Serviços <span style="color:#009245">Concluidos</span> </h3>
                    <h3 class="numero" style="color:#009245">24</h3>
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
                    const config = {
                type: 'line',
            data: data,
                };
                const labels = Utils.months({count: 7});
const data = {
  labels: labels,
  datasets: [{
    label: 'My First Dataset',
    data: [65, 59, 80, 81, 56, 55, 40],
    fill: false,
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.1
  }]
};
                </script>

                                </canvas>
            </div>
            <div class="botoes"></div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
