<a href="{{ route('login.store') }}"></a>

<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<div class="wrapper">
    <!-- Container principal -->
    <div class="container main">
        <!-- Linha para distribuição de conteúdo -->
        <div class="row">
            <!-- Coluna para o formulário de login -->
            <div class="col-md-6 left">
                <div class="input-box">
                    <!-- Cabeçalho do formulário -->
                    <header>Login</header>
                    <!-- Campo de entrada para o email -->
                    <div class="input-field">
                        <input type="email" class="input" id="email" required="" autocomplete="off">
                        <label for="email"><i class="fa-solid fa-envelope"></i>E-mail</label>
                    </div>
                    <!-- Campo de entrada para a senha -->
                    <div class="input-field">
                        <input type="password" class="input" id="pass" required="">
                        <label for="pass"><i class="fa-solid fa-lock"></i> Senha</label>
                    </div>
                    <!-- Botão de envio do formulário -->
                    <div class="input-field  ">
                        <input type="submit" class="submit " value="Entrar">
                    </div>
                    <!-- Link para o cadastro -->
                    <div class="signin">
                        <span>Não tem uma conta? <a href="#">Faça o cadastro aqui!</a></span>
                    </div>
                        @if($mensagem = Session::get('err'))
                            {{$mensagem}}
                        @endif
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        @endif
                </div>
            </div>
            <!-- Coluna para a imagem lateral -->
            <div class="col-md-6 " id="side-image">
                <!-- Adicione o texto sobre a imagem aqui se necessário -->
               <img src="/img/helpHouseLogin.png" alt="">
            </div>
        </div>
    </div>
</div>
