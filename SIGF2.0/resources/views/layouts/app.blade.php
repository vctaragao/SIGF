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

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    {{-- Material-Icons  --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

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
                        @if(Auth::guard()->check() && !(Auth::user()->isDirector))

                            <li class="nav-item"> <a class="nav-link" href={{ url('/studentAll') }}>Ver Alunos</a></li>
                            <li class="nav-item"> <a class="nav-link" href={{ url('/classroomAll') }}>Ver Turmas</a></li>
                            <li class="nav-item"> <a class="nav-link" href={{ url('/professorAll') }}>Ver Professores</a></li>
                            <li class="nav-item"> <a class="nav-link" href={{ url('/directorAll') }}>Ver Diretores</a></li>

                        @elseif(Auth::guard()->check() && Auth::user()->isDirector)

                            <li class="nav-item dropdown">
                                   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Alunos
                                   </a>
                                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                     <a class="dropdown-item" href={{ url('/studentAll') }}>Ver alunos</a>
                                     <a class="dropdown-item" href={{ url('/directorRegister') }}>Adicionar aluno</a>
                                     <div class="dropdown-divider"></div>
                                     <a class="dropdown-item" href={{ url('/studentDelete') }}>Remover aluno</a>
                                   </div>
                                 </li>
                             <li class="nav-item dropdown">
                                   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Professores
                                   </a>
                                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                     <a class="dropdown-item" href={{ url('/professorAll') }}>Ver professores</a>
                                     <a class="dropdown-item" href={{ url('/addProfessor') }}>Adicionar professor</a>
                                     <div class="dropdown-divider"></div>
                                     <a class="dropdown-item" href={{ url('/removeProfessor') }}>Remover professor</a>
                                   </div>
                            </li>
                             <li class="nav-item dropdown">
                                   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Diretores
                                   </a>
                                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                     <a class="dropdown-item" href={{ url('/directorAll') }}>Ver Diretores</a>
                                     <a class="dropdown-item" href={{ url('/addDirector') }}>Adicionar Diretor</a>
                                     <div class="dropdown-divider"></div>
                                     <a class="dropdown-item" href="/removeDirector">Remover Diretor</a>
                                   </div>
                                 </li>
                            <li class="nav-item dropdown">
                                   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Turma
                                   </a>
                                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                     <a class="dropdown-item" href={{ url('/classroomAll') }}>Ver turmas</a>
                                     <a class="dropdown-item" href={{ url('/addClassroom') }}>Criar Turma</a>
                                     <div class="dropdown-divider"></div>
                                     <a class="dropdown-item" href={{ url('/subscription') }}>Iscrições</a>
                                   </div>
                                 </li>

                            <li class="nav-item dropdown">
                                   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Inscrições
                                   </a>
                                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                     <a class="dropdown-item" href={{ url('/openClassrooms') }}>Ver turmas abertas</a>
                                     <a class="dropdown-item" href={{ url('/openSubscription') }}>Abrir inscrições</a>
                                     <div class="dropdown-divider"></div>
                                     <a class="dropdown-item" href={{ url('/closeSubscription') }}>Fechar inscrições</a>
                                   </div>
                            </li>
                            
                        @endif
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            {{-- <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li> --}}
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Criar conta') }}</a></li>
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
                                    
                                        <a class="dropdown-item" href={{ url('/studentEdit/'. Auth::user()->id) }} >Editar informações</a>
                                        <a class="dropdown-item" href={{ url('/changePassword/'. Auth::user()->id) }} >Alterar senha</a>

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

            @if(session('subscription-status'))
                <div class="alert alert-info">
                    {{ session('subscription-status') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script type="text/javascript" charset="utf-8" async defer>
        
            $(document).ready(function(){

              $("#submit_button").click(function(){
                $("input[type=checkbox]").each(function(){
                    if(!$(this)[0].checked){

                        console.log($(this).attr("id"));
                        console.log($(this)[0].disabled);
                        $(this)[0].disabled = true;
                        console.log($(this)[0].disabled);

                        var id = $(this).attr("id") + "b";

                       console.log($("#"+id)[0].disabled);
                       $("#"+id)[0].disabled = false;
                       console.log($("#"+id)[0].disabled);
                    }
                });
              });

            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" type="text/javascript" charset="utf-8" async defer>
        </script>

        
    </footer>
</body>
</html>
