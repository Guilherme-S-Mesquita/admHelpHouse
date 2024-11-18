@extends('layouts.main')

@section('title', 'clientes')

@section('contentAdmin')


<div class="main p-3">
    <link rel="stylesheet" href="{{ asset('css/atendimento.css') }}">

    
            <div class="inicio">
            <div class="header mb-4 ">
                <p>Olá,<span style="color: #ff6347; font-size:30px ">{{$user->name}}</span></p>
            </div>
            </div>
           
            
            <div class="title">
                <p class="titleservico">Atendimentos | Denúncias</p>
            </div>
           

    <div class="tudo">
    <div class="containerEstadoCli">

        <button class="btn-aberto active" onclick="showSection('Aberto')">
        <i class="bi bi-exclamation-triangle-fill"></i>  Em aberto
        </button>
        <br>
        <button class="btn-andamento" onclick="showSection('Andamento')">
        <i class="bi bi-clock-fill"></i>   Em andamento
        </button>
        <br>
        <button class="btn-concluidas" onclick="showSection('concluidas')">
        <i class="bi bi-check-circle-fill"></i> Concluídas
        </button>
    </div>


    <div class="linha"></div>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atendimentos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


    <div class="denuncias">
            <div id="containerPergunta">
                <div class="pergunta" id="pergunta1">
                    <div class="imgCliente"></div>
                    <div class="conteudoPergunta">
                        <p class="nomeCliente">Aline Mendonça</p>
                        <p class="textoPergunta">Como cancelar um serviço após já ter fechado?</p>
                    </div>
                    <p class="dataPergunta">25/10/2024</p>
                </div>
            </div>

            </div>

            <!-- Estrutura do Modal -->
            <div id="modalPergunta" class="modal">
                <div class="modal-content">
                    <h4>Pergunta de Aline Mendonça</h4>
                    <p>Como cancelar um serviço após já ter fechado?</p>
                    <p><strong>Enviada por:</strong> <span style="color: #ff914d;">HelpHouse</span></p>
                    <p><strong>Data:</strong> 25/10/2024</p>
                    <div class="modal-footer">
                        <textarea id="resposta" rows="4" placeholder="Digite sua resposta aqui..."></textarea>
                        <div class="button-group">
                            <button class="btn fechar" id="closeModal">Fechar</button>
                            <button class="btn enviar" >Enviar</button>
                        </div>
                    </div>
                </div>
            </div>

</div>

<script>
    // Abre o modal ao clicar na pergunta
    document.getElementById('pergunta1').addEventListener('click', function() {
        document.getElementById('modalPergunta').style.display = 'block';
    });

    // Fecha o modal ao clicar no botão de fechar
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('modalPergunta').style.display = 'none';
    });

    // Fecha o modal ao clicar fora dele
    window.onclick = function(event) {
        var modal = document.getElementById('modalPergunta');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
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
}.
</script>

</body>
</html>




</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script src="{{ asset('js/clientes.js') }}"></script>
