@extends('layouts.main')

@section('title', 'Controle de Usuários')

@section('contentAdmin')
<div class="container-fluid d-flex p-4">
    <!-- Menu lateral -->
    <div class="menu-lateral">
        <button class="btn-nav active" onclick="showSection('clientes')">
            <i class="fas fa-users"></i>   Clientes
        </button>
        <button class="btn-nav" onclick="showSection('profissionais')">
            <i class="fas fa-user-tie"></i>   Profissionais
        </button>
        <button class="btn-nav" onclick="showSection('administradores')">
            <i class="fas fa-user-shield"></i>   Administradores
        </button>
    </div>

    <div class="linha"></div>



    <!-- Seções das tabelas -->
    <div class="conteudo">
        
        <div id="clientes-section" class="table-section" style=" ">
            <h3>Clientes</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data nas.</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contratantes as $contratante)

                    <tr>
                        <td>{{$contratante->id}}</td>
                        <td>{{$contratante->nomeContratante}}</td>
                        <td>25/02/1977</td>
                        <td>{{$contratante->cpfContratante}}</td>
                        <td>{{$contratante->emailContratante}}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <!-- Adicione mais linhas conforme necessário -->
                    @endforeach
                </tbody>
            </table>
        </div>


        <div id="profissionais-section" class="table-section" style="display: none; ">
            <h3>Profissionais</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data nas.</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contratados as $contratado)
                    <tr>
                        {{-- <td>{{$contratado->id}}</td> --}}
                        <td>{{$contratado->nomeContratado}}</td>
                        <td>{{$contratado->nascContratado}}</td>
                        <td>{{$contratado->cpfContratado}}</td>
                        <td>{{$contratado->emailContratado}}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="administradores-section" class="table-section" style="display: none;">
            <h3>Administradores</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data nas.</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->date}}</td>
                        <td>{{$user->cpf}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/usuários.css') }}">
<script>
function showSection(sectionId) {
    // Oculta todas as seções
    document.querySelectorAll('.table-section').forEach(section => {
        section.style.display = 'none';
    });

    // Remove a classe 'active' de todos os botões
    document.querySelectorAll('.btn-nav').forEach(btn => {
        btn.classList.remove('active');
    });

    // Exibe a seção específica e destaca o botão
    document.getElementById(sectionId + '-section').style.display = 'block';
    document.querySelector(`[onclick="showSection('${sectionId}')"]`).classList.add('active');
}
</script>
@endsection
