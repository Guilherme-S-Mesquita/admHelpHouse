<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bosstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">

    <!-- CSS da aplicação e JS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homeAdmin.css') }}">


    <title>@yield('title')</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg">

            <a class="navbar-brand " href="#"></a>
            <div class="search-container">
                <input type="text" id="search" name="search" class="form-control" placeholder="Procurar" >
                <a href="#"class="btn btn-primary" id="search-submit">
                <ion-icon name="search-outline" ></ion-icon></a>
            </div>
            <div class=" d-flex justify-content-end">
                    <div class="administradorDashboard ">
                     <a href="#">
                    <ion-icon style="border-width: 4px;" size="large" name="person-circle-outline"></ion-icon>
                    </a>
                </div>
                </div>


    </nav>


    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i>
                    <ion-icon size="large" name="menu-sharp"></ion-icon>
                    </i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">HelpHouse</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                    <ion-icon size="large" name="bar-chart-outline"></ion-icon>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                    <ion-icon size="large" name="chatbubble-ellipses-outline"></ion-icon>
                        <span>Atendimento</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                    <ion-icon size="large" name="people-outline"></ion-icon>
                        <span>Usuário</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                    <ion-icon size="large"  name="alert-circle-outline"></ion-icon>
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
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                    <ion-icon size="large" name="cash-sharp"></ion-icon>
                        <span>Financeiro</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Adicionar</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Sair</span>
                </a>
            </div>

        </aside>

    </div>

    @yield('contentAdmin')

    <script src="{{ asset('js/main.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
