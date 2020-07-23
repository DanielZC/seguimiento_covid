<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/mdb.min.css">
        <link rel="stylesheet" href="/css/addons/datatables.min.css">
        <link rel="stylesheet" href="/css/estilos_formulario.css">
    </head>
    <body>
        <div class="linea1"></div>
        <div class="linea2"></div>
        <div class="linea3"></div>
        <nav class="navbar navbar-expand-lg navbar-light fondo-color img-nav">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="img/logo_sin_fondo.png" class="img-fluid" alt="logo-caminos">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--******************************************************-->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a href="{{ route('index') }}" class="nav-link">INICIO</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            PROCESOS
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="{{ route('paciente.crear') }}" class="dropdown-item">Ingresar Pacientes</a>
                            <a href="{{ route('programacion.crear') }}" class="dropdown-item">Programar Primera Toma Muestra</a>
                            <a href="segto_evolucion.php" class="dropdown-item">Ingresar Seguimiento Diario Por Paciente</a>
                            <a href="historial_paciente.php" class="dropdown-item">Ver Seguimiento Paciente</a>
                            <a href="toma_muestra_control.php" class="dropdown-item">Programar Segunda Toma Muestra (Control)</a>
                    </li>
        
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            INGRESAR RESULTADOS
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="nav-link " href="#" id="navbarDropdown" data-target='#exampleModal' role="button"
                            data-toggle="modal" aria-haspopup="true" aria-expanded="false">
                            Ingresar Fecha de Realizacion de la toma
                        </a>
                        <a class="nav-link " href="#" id="navbarDropdown" data-target='#exampleModal' role="button"
                            data-toggle="modal" aria-haspopup="true" aria-expanded="false">
                            Ingresar Resultado Primera Vez
                        </a>
                        <a class="nav-link " href="#" id="navbarDropdown" data-target='#modalTomaMuestraControl'
                            role="button" data-toggle="modal" aria-haspopup="true" aria-expanded="false">
                            Ingresar Resultado Segunda Vez (Control)
                        </a>
                        </div>
                    </li>
        
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            LISTADO DE PACIENTES
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="{{route('paciente.index')}}" class="dropdown-item" href="#">Listar Todos los Pacientes</a>
                        </div>
                    </li>
        
                    <li class="nav-item dropdown">
                        <a href="soporte_resultado.php" class="nav-link">INGRESAR SOPORTE RESULTADO</a>
                    </li>
                </ul>
            </div>
        </nav>
        {{-- <div class="flex-center position-ref full-height"> --}}
            {{-- @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif --}}

        {{-- </div> --}}

        <div class="container-fluid pt-4 mb-5">
            @yield('contenido')
        </div>
    </body>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/mdb.min.js"></script>
    <script src="/js/addons/datatables.min.js"></script>
    <script src="/js/tables.js"></script>
</html>
