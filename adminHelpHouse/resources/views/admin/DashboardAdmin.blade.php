@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')


<div class="main p-3">
    <div class="title">
        <p class="titleDashboard">Dashboard</p>
    </div>

    <div class="containerAdmin">
        <div class="infosAdmin">
            <div class="contratantes">
                <div class="contratantes-itens">
                    <ion-icon size="large" name="add-outline"></ion-icon>
                    <p class="numContratados">56</p>
                    <div class="novosContratantes">
                        <p class="novos">Novos</p>
                        <p class="contratantes">Contratantes</p>
                    </div>
                </div>


            </div>
            <div class="Profissionais">
                <div class="contratantes-itens">
                    <ion-icon size="large" name="add-outline"></ion-icon>
                    <p class="numProfissionais">56</p>
                    <div class="novosProfissionais">
                        <p class="novosProfissionais">Novos</p>
                        <p class="profissionais">Contratantes</p>
                    </div>
                </div>

            </div>
            <div class="osNaoSei">
                <div class="naoSei ">

                </div>
                <div class="naoSei2 ">

                </div>
            </div>
        </div>

        <div class="infoAdmin2">
            <div class="segundaColuna">
                <div class="perguntas">

                </div>
                <div class="infoAdmin">

                </div>
            </div>
            <div class="segundaLinha">
                <div class="info">

                </div>
                <div class="info2">

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
