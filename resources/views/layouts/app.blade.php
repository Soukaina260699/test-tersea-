<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- modals --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    {{-- Style --}}
    <link rel="stylesheet" href="/css/style.css">
    
    <!-- Inclure jQuery -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script type="module" src="/js/script.js"></script>
    <!-- Inclure DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Inclure les fichiers CSS et JavaScript de Swal -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo" src="/images/LogoCRM.png" alt="Logo CRM">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            <div class="container-fluid px-0">
                <div class="row mx-0 justify-content-center">
                    @auth
                        <div class="col-lg-4 col_sidebar shadow">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.create') }}">
                                        <i class="fas fa-user-plus cl_grey"></i>
                                        <span>Ajouter un admistrateur</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.index') }}">
                                        <i class="fas fa-users-cog cl_grey"></i>
                                        <span>Liste d'administrateur</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('societes.index') }}">
                                        <i class="fas fa-building cl_grey"></i>
                                        <span>Espace societé</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('invitations.create') }}">
                                        <i class="fas fa-plus-circle cl_grey"></i>
                                        <span>Créer une invitation</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('invitations.index') }}">
                                        <i class="fas fa-calendar-plus cl_grey"></i>
                                        <span>Consulter les invitations</span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('historique.index') }}">
                                        <i class="fas fa-history cl_grey"></i>
                                        <span>Historique des actions</span> 
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-8 pt-5">@yield('content')</div>
                    @else
                        <div class="col-lg-10 pt-5">@yield('content')</div>
                    @endauth 
                </div>
            </div>
        </main>
    </div>
</body>
</html>
