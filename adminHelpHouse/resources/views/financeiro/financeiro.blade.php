@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')

<link rel="stylesheet" href="{{ asset('css/financeiro.css') }}">

<div class="main p-3">
    <div class="backdrop">
        <div class="title">
            <p>Controle de Informações</p>
        </div>

        <div class="tudo">
            <div class="primeiracoluna">
            <div class="nome"><p class="nome">Média de valores dos serviços</p></div>
                <div class="fazL">
                    <canvas id="frankocean" width="500" height="250"></canvas>
                </div>

                <div class="mediaval">
                    <div>
                    <div class="nome"><p class="nome">Média de valores dos serviços</p></div>
                    <div class="icon"><i class="material-icons">tune</i></div>
                    </div>
                </div>

                <div class="serviçosmes">
                    <div>
                    <div class="nome"><p >Serviços realizados no mês de:</p></div>
                    <div class="icon"><i class="material-icons">today</i></div>
                    </div>
                  </div>
            </div>

            <div class="segundacoluna">
                <div class="chartusers">
                    <canvas id="cachorro" width="350" height="300"></canvas>
                </div>
                
                <div class="crescimentousers">
                    <canvas id="vsfd" width="500" height="250"></canvas>
                </div>
            </div>

            <div class="terceiracoluna">
                <div class="despesareceita">
                    <canvas id="goodnight" width="400" height="300"></canvas>
                </div>
                <div class="metodosdepag"></div>
                <div class="nseiainda"></div>
            </div>
        </div>
    </div>
</div>

<!-- Inclua o script do Chart.js -->
<div class="chart">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Primeiro gráfico
            const ctx1 = document.getElementById('cachorro').getContext('2d');
            new Chart(ctx1, {
                type: 'pie', // Tipo de gráfico (pode ser 'bar', 'line', etc.)
                data: {
                    labels: ['Usuários Comuns', 'Usuários Premium'],
                    datasets: [{
                        label: 'Distribuição de Usuários',
                        data: [70, 30],
                        backgroundColor: [
                            '#0448B6',
                            '#F5FA4F',
                        ],
                        hoverOffset: 4
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
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });

            // Segundo gráfico
            const ctx2 = document.getElementById('vsfd').getContext('2d');
            new Chart(ctx2, {
                type: 'line', // Tipo de gráfico (pode ser 'bar', 'line', etc.)
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'], // Labels para o eixo x
                    datasets: [{
                        label: 'Dataset de Exemplo',
                        data: [0, 10, 20, 30, 40, 50], // Dados para o gráfico
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
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
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });

            // Terceiro gráfico
            const ctx3 = document.getElementById('goodnight').getContext('2d');
            new Chart(ctx3, {
                type: 'bar', // Tipo de gráfico (pode ser 'bar', 'line', etc.)
                data: {
                    labels: ['Receita', 'Despesas', ], // Labels para o eixo x
                    datasets: [{
                        label: 'Receitas',
                        data: [12, 19, 3, 5, 2, 3], // Dados para o gráfico
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 206, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(153, 102, 255)',
                            'rgb(255, 159, 64)'
                        ],
                        borderWidth: 1
                    }]
                    [{
                        label: 'Despesas',
                        data: [12, 19, 3, 5, 2, 3], // Dados para o gráfico
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 206, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(153, 102, 255)',
                            'rgb(255, 159, 64)'
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
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
          // Segundo gráfico
          const ctx2 = document.getElementById('frankocean').getContext('2d');
            new Chart(ctx2, {
                type: 'line', // Tipo de gráfico (pode ser 'bar', 'line', etc.)
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'], // Labels para o eixo x
                    datasets: [{
                        label: 'Dataset de Exemplo',
                        data: [0, 10, 20, 30, 40, 50], // Dados para o gráfico
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
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
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
    </script>
</div>

@endsection
