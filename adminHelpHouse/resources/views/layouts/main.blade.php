<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- CSS da aplicação e JS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homeAdmin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuários.css') }}">

    <!-- fontess -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>@yield('title')</title>
</head>

<body>

    <!-- Overlay para o efeito de desfoque -->
    <div id="overlay"></div>


    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#"></a>
        <div class="search-container">
            <input type="text" id="search" name="search" class="form-control" placeholder="Procurar">
            <a href="#" class="btn btn-primary" id="search-submit">
                <ion-icon name="search-outline"></ion-icon>
            </a>
        </div>
        <div class="d-flex justify-content-end">
            <div class="administradorDashboard">
                <a class="entrar-main" href="{{ route('login.index') }}">entrar</a>
                <a href="#">
                    <ion-icon style="border-width: 4px;" size="large" name="person-circle-outline"></ion-icon>
                </a>
            </div>
        </div>
    </nav>

    @if(session('msg'))
        <p class="msg">{{session('msg')}}</p>
    @endif

    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn"  type="button" onclick="toggleOverlay()">
                    <i>
                        <ion-icon size="large" name="menu-sharp"></ion-icon>
                    </i>
                </button>
                <div class="sidebar-logo">
                    <img class="helphouseImg" src="/img/helphouse.png" alt="">
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="/admin/DashboardAdmin" class="sidebar-link">
                        <img src="/img/dashboard.png" alt="">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <img src="/img/atendimento.png" alt="">
                        <span>Atendimento</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/users" class="sidebar-link">
                        <img src="/img/usuarios.png" alt="">
                        <span>Usuário</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <img src="/img/denuncias.png" alt="">
                        <span>Denuncias</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Banimentos</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Suspensões</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="/financeiro/controleinfos" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                    <div class="iconesidebar"><i class="material-icons">public</i></div>
                        <span>Central</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/add/servico" class="sidebar-link">
                        <img src="/img/adicionar.png" alt="">
                        <span>Adicionar</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <form action="{{ route('login.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <a href="{{route('login.index')}}">
                    <i class="lni lni-exit"></i>
                   </a>
                </form>
            </div>
        </aside>
        <div class="backdrop"></div>

        @yield('contentAdmin')

    </div>

    <script src="{{ asset('js/main.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        function toggleOverlay() {
            var overlay = document.getElementById('overlay');
            overlay.classList.toggle('active');
        }
    </script>

</body>

</html>
