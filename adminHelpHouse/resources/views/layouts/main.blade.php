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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


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



    @if(session('msg'))
        <p class="msg">{{session('msg')}}</p>
    @endif

    <div class="wrapper">
        <aside id="sidebar">

            

            <div class="d-flex">
                <button class="toggle-btn"  type="button" onclick="toggleOverlay()">
                <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
                </button>
            </div>

            <ul class="sidebar-nav">

            <div class="infosconta">
                <div class="ftperfil">
                        <div class="foto"></div>
                </div>
                <div class="infosadd">
                    <h3>Nome</h3>
                    <h5>Administrador</h5>
                    
                </div>
            </div>

            <div class="fio"></div>

                <li class="sidebar-item">
                    <a href="/admin/DashboardAdmin" class="sidebar-link">
                    <i class="fa-solid fa-chart-simple" style="color: #ffffff;"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-bell" style="color: #ffffff;"></i>
                        <span>Atendimentos</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="/users" class="sidebar-link">
                    <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                        <span>Usuários</span>
                    </a>
                </li>

               

                <li class="sidebar-item">
                    <a href="/add/servico" class="sidebar-link">
                    <i class="fa-solid fa-screwdriver-wrench" style="color: #ffffff;"></i>
                        <span>Serviços</span>
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
