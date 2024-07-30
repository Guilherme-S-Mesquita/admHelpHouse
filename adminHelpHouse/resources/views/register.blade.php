<form action="{{ route('login.processoDeRegistro') }}" method="POST">
    @csrf
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 left">
                    <div class="input-box">
                        <header>Cadastro</header>

                        <div class="input-field">
                            <input type="text" name="name" id="name" class="input @error('name') is-invalid @enderror" autocomplete="off">
                            <label for="name"><i class="fa-solid fa-user"></i>Nome completo</label>
                            @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-field">
                            <input type="email" value="{{ old('email') }}" name="email" id="email" class="input @error('email') is-invalid @enderror" autocomplete="on">
                            <label for="email"><i class="fa-solid fa-envelope"></i>E-mail</label>
                            @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-field">
                            <input type="password" name="password" id="pass" class="input @error('password') is-invalid @enderror">
                            <label for="pass"><i class="fa-solid fa-lock"></i>Senha</label>
                            @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-field">
                            <input type="password" name="password_confirmation" id="pass_confirmation" class="input @error('password_confirmation') is-invalid @enderror">
                            <label for="pass_confirmation"><i class="fa-solid fa-lock"></i>Confirmar senha</label>
                            @error('password_confirmation')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-field">
                            <input type="submit" class="submit" value="Registrar">
                        </div>
                    </div>
                </div>

                <div class="col-md-6" id="side-image">
                   <img src="/img/helpHouseLogin.png" alt="">
                </div>
            </div>
        </div>
    </div>
</form>
