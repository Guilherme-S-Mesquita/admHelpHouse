@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')

<div class="main p-3">

<link rel="stylesheet" href="{{ asset('css/clientes.css') }}">

<div class="titleContainer">
        <p class="titleClientes" id="titleDashboard">Solicitações em aberto</p>
    </div>



    <div class="containerEstadoCli">
        <div class="estado" >
            <div class="emAbertoCli">
                <button class="condicaoCli">
                    <p>Em aberto</p>
                </button>

            </div>
            <div  class="aceitos" >
                <button>
                    <a href="#"><p>Em aberto</p></a>
                </button>
            </div>
            <div class="negados">
                <button>
                    <a href="#"><p>Em aberto</p></a>
                </button>
            </div>
        </div>
    </div>
    <div id="containerClientes">
        <div class="tabelaClientes" id="green">
        <div class="row">
        <div class="col-md-12">



            <table class="table">
                <thead>
                    {{-- <tr>

                        <th>Nome</th>
                        <th>Email</th>
                        <th>Nascimento</th>
                        <th>Cpf</th>
                        <th>Edit</th>
                        <th>Excluir</th>
                    </tr> --}}
                </thead>
                <tbody>

                    <tr>
                        <td>
                            <div class="imgCliente">

                            </div>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            {{-- <a href="" class="btn btn-info edit-btn">
                                <ion-icon name="create-outline"></ion-icon> Editar
                            </a> --}}
                        </td>
                        <td>

                        </td>
                    </tr>


                </tbody>

        </div>
    </div>


 <script>
        function toggleGreen(){
            var green = document.getElementById('green');
            green.classList.toggle('verdeAtivo')
        }
 </script>

@endsection
