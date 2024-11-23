@extends('layouts.main')

@section('title', 'Controle de Usuários')

@section('contentAdmin')


    <div class="inicio">

            <div class="header mb-4 ">
                <p>Olá,<span style="color: #ff6347; font-size:35px ">{{$user->name}}</span></p>
            </div>

            <div class="search-container">
                <input type="text" class="search-input" placeholder="Pesquisar...">
                <button class="search-btn"><i class="bi bi-search"></i></button>
            </div>

            </div>


            <div class="title">
                <p class="titleservico">Controle de usuários</p>
            </div>


<div class="tudo">

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
                        <th>  </th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data nas.</th>
                        <th>CPF</th>
                        <th>Email</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($contratantes as $contratante)

                    <tr>
                        <td>
                            <img src="{{ $contratante->imagemContratante }}"
                                 alt="Imagem do Contratante"
                                 style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                        </td>
                        <td>{{$contratante->id}}</td>
                        <td>{{$contratante->nomeContratante}}</td>
                        <td>{{$contratante->nascContratante}}</td>
                        <td>{{$contratante->cpfContratante}}</td>
                        <td>{{$contratante->emailContratante}}</td>
                        <td>
                            <form action="{{ route('users.deleteContratante', $contratante->idContratante) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
                        <th>  </th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data nas.</th>
                        <th>CPF</th>
                        <th>Email</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($contratados as $contratado)
                    <tr>
                        {{-- <td>{{$contratado->id}}</td> --}}
                        <td>
                            <img src="{{ $contratado->imagemContratado }}"
                                 alt="Imagem do Contratado"
                                 style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                        </td>
                        <td>{{$contratado->id}}</td>
                        <td>{{$contratado->nomeContratado}}</td>
                        <td>{{$contratado->nascContratado}}</td>
                        <td>{{$contratado->cpfContratado}}</td>
                        <td>{{$contratado->emailContratado}}</td>
                        <td>
                            <form action="{{ route('users.deleteContratado', $contratado->idContratado) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
                            <form action="{{ route('users.deleteAdmin', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
