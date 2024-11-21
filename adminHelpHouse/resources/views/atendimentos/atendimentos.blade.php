@extends('layouts.main')

@section('title', 'Gerenciamento de Denúncias')

@section('contentAdmin')

<div class="main p-3">
    <link rel="stylesheet" href="{{ asset('css/atendimento.css') }}">

    <div class="inicio">
        <div class="header mb-4">
            <p>Olá, <span style="color: #ff6347; font-size:30px">{{ $user->name }}</span></p>
        </div>
    </div>

    <div class="title">
        <p class="titleservico">Gerenciamento de Denúncias</p>
    </div>

    <div class="tudo">
        <!-- Menu lateral para as categorias de denúncias -->
        <div class="containerEstadoCli">
            <button class="btn-aberto active" onclick="showSection('emAberto')">
                <i class="fas fa-folder-open"></i> Em Aberto
            </button>
            <button class="btn-andamento" onclick="showSection('emAndamento')">
                <i class="fas fa-tasks"></i> Em Andamento
            </button>
            <button class="btn-concluidas" onclick="showSection('concluidas')">
                <i class="fas fa-check-circle"></i> Concluídas
            </button>
        </div>

        <div class="linha"></div>

        <!-- Seção de denúncias -->
        <div class="denuncias">

            <!-- Tabela de Denúncias em Aberto -->
            <div id="emAberto-section" class="table-section">
                <h4>Denúncias em Aberto</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Contratante</th>
                            <th>Contratado</th>
                            <th>Descrição</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($denunciasEmAberto as $denuncia)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $denuncia->contratante->nomeContratante ?? 'N/A' }}</td>
                            <td>{{ $denuncia->contratado->nomeContratado }}</td>
                            <td>{{ $denuncia->descricao }}</td>
                            <td>{{ $denuncia->created_at->format('d/m/Y') }}</td>
                            <td>
                                <button
                                    class="btn btn-sm btn-success"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalAnalise"
                                    onclick="setModalData(
                                        '{{ $denuncia->contratante->nomeContratante ?? 'N/A' }}',
                                        '{{ $denuncia->descricao }}',
                                        '{{ $denuncia->created_at->format('d/m/Y') }}',
                                        '{{ $denuncia->id }}')">
                                    Analisar
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Nenhuma denúncia em aberto.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tabela de Denúncias em Análise -->
            <div id="emAndamento-section" class="table-section">
                <h4>Denúncias em Análise</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Contratante</th>
                            <th>Contratado</th>
                            <th>Descrição</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($denunciasEmAndamento as $denuncia)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $denuncia->contratante->nomeContratante ?? 'N/A' }}</td>
                            <td>{{ $denuncia->contratado->nomeContratado }}</td>
                            <td>{{ $denuncia->descricao }}</td>
                            <td>{{ $denuncia->created_at->format('d/m/Y') }}</td>
                            <td>
                                <button
                                    class="btn btn-sm btn-danger"
                                    onclick="handleConclusao(this)"
                                    data-id="{{ $denuncia->id }}">
                                    Concluir
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Nenhuma denúncia em análise.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tabela de Denúncias Concluídas -->
            <div id="concluidas-section" class="table-section">
                <h4>Denúncias Concluídas</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Contratante</th>
                            <th>Contratado</th>
                            <th>Descrição</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($denunciasConcluidas as $denuncia)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $denuncia->contratante->nomeContratante ?? 'N/A' }}</td>
                            <td>{{ $denuncia->contratado->nomeContratado }}</td>
                            <td>{{ $denuncia->descricao }}</td>
                            <td>{{ $denuncia->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">Nenhuma denúncia concluída.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalAnalise" tabindex="-1" aria-labelledby="modalAnaliseLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1d4ed8; color: white;">
                    <h5 class="modal-title" id="modalAnaliseLabel">Analisar Denúncia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-start mb-3">
                        <img src="https://via.placeholder.com/50" alt="Perfil" class="rounded-circle me-3">
                        <div>
                            <h6 class="fw-bold" id="contratanteNome">Nome do Contratante</h6>
                            <p id="denunciaDescricao">Descrição</p>
                            <p class="text-muted">
                                Enviada em <span id="denunciaData">Data</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        class="btn btn-sm btn-success"
                        onclick="handleAnalise(this)"
                        data-id="">
                        Enviar para análise
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showSection(sectionId) {
        document.querySelectorAll('.table-section').forEach(section => {
            section.style.display = 'none';
        });
        document.querySelectorAll('.btn-aberto, .btn-andamento, .btn-concluidas').forEach(btn => {
            btn.classList.remove('active');
        });
        document.getElementById(sectionId + '-section').style.display = 'block';
        document.querySelector(`[onclick="showSection('${sectionId}')"]`).classList.add('active');
    }

    function setModalData(contratanteNome, denunciaDescricao, denunciaData, idDenuncia) {
        document.getElementById('contratanteNome').textContent = contratanteNome;
        document.getElementById('denunciaDescricao').textContent = denunciaDescricao;
        document.getElementById('denunciaData').textContent = denunciaData;

        // Definir o ID da denúncia no botão
        document.querySelector('#modalAnalise .btn-success').setAttribute('data-id', idDenuncia);
    }

    function handleAnalise(button) {
        const idDenuncia = button.getAttribute('data-id');

        fetch(`/denuncia/${idDenuncia}/acao`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ acao: 'emAnalise' })
        }).then(response => response.json())
          .then(data => {
              alert(data.message || data.error);
              location.reload();
          });
    }

    function handleConclusao(button) {
        const idDenuncia = button.getAttribute('data-id');

        fetch(`/denuncia/${idDenuncia}/acao`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ acao: 'concluido' })
        }).then(response => response.json())
          .then(data => {
              alert(data.message || data.error);
              location.reload();
          });
    }
</script>

@endsection
