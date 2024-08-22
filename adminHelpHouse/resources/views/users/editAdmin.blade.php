@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')

<link rel="stylesheet" href="{{ asset('css/editAdmin.css') }}">


            <!-- titulo -->
 
            <div class="main p-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <p>Perfil Administrador</p>
                        </div>

            <!-- parte do usuario 1: foto-->

            <div class="tudo">
                <div class="parteum">
                    <div class="foto"></div>

                    <div class="ptbotao">
                         <button >Alterar foto</button>
                    </div>
                </div>

            <!-- parte do usuario 2: Infos-->

                <div class="partedois">

                    <div class="formulário">
                        <form action="{{ route('update.admins', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group" id="inputs">
                            <label for="nomeServicos"><p class="nomezinho">Nome do administrador:</p></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>
                      
                        <div class="form-group" id="inputs">
                            <label for="precoServicos"><p class="nomezinho">CPF:</p></label>
                            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $user->cpf }}" required>
                        </div>

                        <div class="form-group" id="inputs">
                            <label for="precoServicos"><p class="nomezinho">Data de Nascimento</p></label>
                            <input type="date" class="form-control" id="data" name="data" value="{{ $user->dataDeNascimento }}" required>
                        </div>

                        <div class="form-group " id="inputs">
                            <label for="descServicos"><p class="nomezinho">Descrição:</p></label>
                            <textarea class="form-control" id="email" name="email" required>{{ $user->email}}</textarea>
                        </div>

                       
                             </form>
                            </div>
                         </div>
                        </div>

            <!-- botões finais-->

                        <div class="botoes">
                            <div class="planos">
                            <button type="submit" class="btn btn-primary" id="mudarFoto">Salvar Alterações</button>           
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Excluir Usuário
                            </button>
                            </div>
                        </div>

               
             <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Usuário</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               Tem certeza que deseja excluir esse usuário? As alterações não podem ser desfeitas.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Excluir</button>
                                <button type="button" class="btn btn-primary">Cancelar</button>
                            </div>
                            </div>
                        </div>
                        </div>
             
            
                    </div>
                </div>
            </div>
@endsection



