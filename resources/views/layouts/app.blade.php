<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">

        <!-- Header -->
        <header class="main-header">
            <nav class="navbar navbar-expand-md navbar-dark bg-espe shadow-sm">
                <div class="container">

                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        @auth
                        <ul class="navbar-nav mr-auto">
                            <!-- Reservation menu -->
                            <li class="nav-item">
                                <a href="{{ url('reservation') }}" class="nav-link">Réservations</a>
                            </li>

                            <!-- Ressources menu -->
                            <li class="nav-item">
                                <a href="{{ url('material') }}" class="nav-link">Ressources</a>
                            </li>

                            <!-- Admin menu -->
                            @if (Auth::user()->isAdmin())
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Administration
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('admin/category') }}">
                                        Gestion des catégories
                                    </a>

                                    <a class="dropdown-item" href="{{ url('admin/material') }}">
                                        Gestion du matériel
                                    </a>

                                    <a class="dropdown-item" href="{{ url('admin/test') }}">
                                        Page de test
                                    
                                    </a>
                                    <a class="dropdown-item" href="{{ url('admin/info') }}">
                                        Informations serveur
                                    </a>
                                </div>
                            </li>
                            @endif
                        </ul>
                        @endauth

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @auth
                            <li class="nav-item dropdown">
                                <!-- User item -->
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}
                                    @if (Auth::user()->isAdmin())
                                    (admin)
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user"></i> Mes informations
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cog"></i> Mes préférences
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="far fa-question-circle"></i> Aide
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        A propos
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        <i class="fas fa-power-off"></i> Déconnexion
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Main frame -->
        <main class="py-3">
            @yield('content')
        </main>

    </div>

    <footer class="main-footer font-small">
        <div class="footer-copyright text-center container">
            <div class="row align-items-center">
                <div class="col">
                    <p>© Copyright 2020 Ecole supérieur du professorat et de l'éducation de la Polynésie Française
                        (<a href="http://espe.upf.pf">espe.upf.pf</a>)</p>

                </div>
            </div>
        </div>
    </footer>
</body>

</html>