@if ($mensagem = Session::get('erro'))
    <div>{{ $mensagem }}</div>
@endif

<form action="{{ route('login.auth') }}" method="POST">
    @csrf

    Email: <br><input type="email" name="email" required><br>
    Senha: <br><input type="password" name="password" required><br>
    <button type="submit">Entrar</button>
</form>
