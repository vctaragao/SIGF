<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'SIGF') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(Auth::guard()->check() && Auth::user()->isDirector)
                            <li class="nav-item"> <a class="nav-link" href="">Alunos</a></li>
                            <li class="nav-item"> <a class="nav-link" href="">Professores</a></li>
                            <li class="nav-item"> <a class="nav-link" href="">Diretores</a></li>
                            <li class="nav-item dropdown">
                                   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Turma
                                   </a>
                                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                     <a class="dropdown-item" href={{ url('/Classrooms') }}>Ver turmas</a>
                                     <a class="dropdown-item" href={{ url('/addClassroom') }}>Adicionar Turma</a>
                                     <div class="dropdown-divider"></div>
                                     <a class="dropdown-item" href="#">Remover Turma</a>
                                   </div>
                                 </li>
                        @elseif(Auth::guard()->check() && Auth::user()->isProfessor)
                            <li class="nav-item"> <a class="nav-link" href="">Alunos</a></li>
                            <li class="nav-item"> <a class="nav-link" href="">Professores</a></li>
                            <li class="nav-item"> <a class="nav-link" href="">Ver Turmas</a></li>

                        @elseif(Auth::guard()->check() && Auth::user()->isStudent)
                            <li class="nav-item"> <a class="nav-link" href={{ url('/Classrooms') }}>Ver Turmas</a></li>
                            
                        @endif
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            {{-- <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li> --}}
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href={{ url('/studentEdit') }} >Editar informações</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
