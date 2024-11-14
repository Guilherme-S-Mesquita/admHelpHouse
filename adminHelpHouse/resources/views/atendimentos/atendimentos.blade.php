@extends('layouts.main')

@section('title', 'clientes')

@section('contentAdmin')

<div class="main p-3">
    <link rel="stylesheet" href="{{ asset('css/clientes.css') }}">

    <div class="titleContainer">
        <p class="titleClientes" id="titleDashboard">Atendimento | Perguntas</p>
    </div>

    <div class="containerEstadoCli">
        <div class="estado">
            <div class="status emAbertoCli">Em aberto</div>
            <div class="status emAndamentoCli">Em andamento</div>
            <div class="status concluidasCli">Concluídas</div>
        </div>
    </div>


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal de Pergunta</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

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
</script>

</body>
</html>




</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script src="{{ asset('js/clientes.js') }}"></script>
