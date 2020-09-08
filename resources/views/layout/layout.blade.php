<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="/css/fontGoogle/nunitoFonts.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/fontAwesome/all.min.css">
        <link rel="stylesheet" href="/css/fontAwesome/fontawesome.min.css">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/mdb.min.css">
        <link rel="stylesheet" href="/css/addons/datatables.min.css">
        <link rel="stylesheet" href="/css/toastr/toastr.min.css">
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
                        {{-- <a href="{{ route('index') }}" class="nav-link">INICIO</a> --}}
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
                        </div>
                    </li>
        
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            INGRESAR RESULTADOS
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="nav-link " href="#" id="navbarDropdown" data-target='#fechaRealizacion' role="button"
                                data-toggle="modal" aria-haspopup="true" aria-expanded="false">
                                Ingresar Fecha de Realizacion de la toma
                            </a>
                            <a class="nav-link " href="#" id="navbarDropdown" data-target='#ingresoResultado' role="button"
                                data-toggle="modal" aria-haspopup="true" aria-expanded="false">
                                Ingresar Resultado Primera Vez
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
            @yield('modalIngresarResultado')
        </div>

        {{-- Modals --}}

        {{-- Modal fecha de realizacion --}}
        <div class="modal fade" id="fechaRealizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ingreso de fecha de realizacion de la toma de muestra</h5>
                        <button type="button" id="close-modal-fr" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="modal-buscar-fr">
                            <div class="form-group">
                                <input type="hidden" id="URL_buscar-programacion" class="form-control"  value="{{ route('programacion.buscarFechaProgramacion') }}">
                                <input type="hidden" id="URL_ingresar-fecha_realizacion" class="form-control"  value="{{ route('programacion.ingresarFechaRealizacion') }}">
                                <label>Ingrsar numero de documento</label>
                                <input type="text" id="numero_documento-modal" class="form-control">
                                <small name="err" id="err-numero_documento-modal" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <a id="buscar-fecha_programacion" class="btn btn-primary">Buscar</a>
                                <div hidden id="spinner-buscar-modal" class="spinner-border text-primary" role="status">
                                </div>
                            </div>
                        </form>
                        <div hidden id="div-form-modal">
                            <form id="form-fechaRealizacion" class="mt-3">
                                <hr>
                                <div class="">
                                    <h5>Informacion de la toma de muestra</h5>
                                    {{-- Renderizado de datos del paciente --}}
                                    <div class="alert alert-primary" role="alert">
                                        <h4 class="alert-heading">Datos personales del paciente</h4>
                                        <hr>
                                        <p id="nombrePaciente-modal"></p>
                                        <p id="documentoPaciente-modal"></p>
                                        <p id="edadPaciente-modal"></p>
                                    </div>
                                    {{-- Fin Renderizado de datos del paciente --}}
                                </div>
                                <div class="form-group">
                                    <label>Fecha de programacion</label>
                                    <input hidden type="text" id="paciente_id-modal" class="form-control">
                                    <input type="text" id="fecha_programacionModal" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Fecha de realizacion de la toma de muestra</label>
                                    <input type="date" id="fecha_realizacion" class="form-control">
                                    <small name="err-form" id="err-fecha_realizacion-modal" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>Visita Exitosa</label>
                                    <select id="visita_exitosa" class="custom-select">
                                        <option value="">Selecionar opcion</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    <small name="err-form" id="err-visita_exitosa-modal" class="text-danger"></small>
                                </div>
                                <div hidden id="form-group-motivo" class="form-group">
                                    <label>Motivo de la visita fallida</label>
                                    <textarea id="motivo-modal" cols="30" rows="4" class="form-control"></textarea>
                                    <small name="err-form" id="err-motivo-modal" class="text-danger"></small>
                                </div>
                                <div id="form-group-tipo_prueba" class="form-group">
                                    <label>Tipo de prueba aplicada al paciente</label>
                                    <select id="tipo_prueba" class="custom-select">
                                        <option value="">Selecionar tipo de prueba</option>
                                        <option value="PCR">PCR</option>
                                        <option value="IGG">IGG</option>
                                        <option value="IGM">IGM</option>
                                    </select>
                                    <small name="err-form" id="err-tipo_prueba-modal" class="text-danger"></small>
                                </div>
                                <div id="form-group-observacion" class="form-group">
                                    <label>Observacion</label>
                                    <textarea id="observacion" cols="30" rows="4" class="form-control"></textarea>
                                    <small name="err-form" id="err-observacion-modal" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <a id="guardar-fechaRealizacion" class="btn btn-primary">Guardar datos</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal fecha de realizacion --}}

        {{-- Modal ingreso de resultados --}}
        <div class="modal fade" id="ingresoResultado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="">Ingreso de resultado de toma de muestra</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="buscar-paciente_ingreso_resultado">
                            <label>Ingrsar numero de documento</label>
                            <input type="text" id="numero_documento-modal-ingreso_resultado" class="form-control">
                            <input type="text" id="URL-ingreso_resultado" class="form-control" value="{{ route('programacion.buscarPacienteResultado') }}">
                            <input type="text" id="numero_documento-modal-ingreso_resultado" class="form-control">
                            <div class="form-group">
                                <a id="buscar-modal-ingreso_resultado" class="btn btn-primary">Buscar</a>
                                <div hidden id="spinner-buscar-modal-ingreso_resultado" class="spinner-border text-primary" role="status">
                                </div>
                            </div>
                        </form>
                        <div id="div-form-ingreso_resultado">
                            <div hidden id="div-form-modal">
                                <form id="form-fechaRealizacion" class="mt-3">
                                    <hr>
                                    <div class="">
                                        <h5>Informacion de la toma de muestra</h5>
                                        {{-- Renderizado de datos del paciente --}}
                                        <div class="alert alert-primary" role="alert">
                                            <h4 class="alert-heading">Datos personales del paciente</h4>
                                            <hr>
                                            <p id="nombrePaciente-modal-ingreso_resultado"></p>
                                            <p id="documentoPaciente-modal-ingreso_resultado"></p>
                                            <p id="edadPaciente-modal-ingreso_resultado"></p>
                                        </div>
                                        {{-- Fin Renderizado de datos del paciente --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha de programacion</label>
                                        <input hidden type="text" id="paciente_id-modal" class="form-control">
                                        <input type="text" id="fecha_programacionModal" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <a id="guardar-fechaRealizacion" class="btn btn-primary">Guardar datos</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Fin Modal ingreso de resultados --}}


    </body>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/mdb.min.js"></script>
    <script src="/js/addons/datatables.min.js"></script>
    <script src="/js/tables.js"></script>
    <script src="/js/toastr/toastr.min.js"></script>
    <script src="/js/fontAwesome/all.min.js"></script>
    <script src="/js/fontAwesome/fontawesome.min.js"></script>
    <script src="/js/app-js/modal/ingresoFechaRealizacion.js"></script>
    <script src="/js/app-js/programacion_toma_muestra/buscar.js"></script>
    <script src="/js/app-js/programacion_toma_muestra/crear.js"></script>
    <script src="/js/app-js/programacion_toma_muestra/eventos.js"></script>
</html>
