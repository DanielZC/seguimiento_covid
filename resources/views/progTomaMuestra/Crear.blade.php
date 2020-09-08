@extends('layout.Layout')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="card col-sm-6">
                <div class="card-body">
                    <h4>Programacion de pacientes para la toma de muestra</h4>
                    <hr>
                    <form method="POST">
                        <div class="form-group">
                            <label>Ingrese numero de identificacion</label>
                            <input type="hidden" id="url_bucarPaciente" value="{{ route('programacion.buscarPaciente') }}">
                            <input type="text" id="numero_documento" class="form-control">
                            <small id="err-numero_documento" class="text-danger"></small>
                        </div>
                        <a id="buscarPaciente" class="btn btn-primary">Buscar</a>
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                <div hidden id="card-paciente" class="card card-cascade">
                    <div class="view view-cascade gradient-card-header blue-gradient">
                        <h2 id="nombrePacienteTitulo" class="card-header-title mb-3 mt-2 text-center text-white"></h2>
                    </div>
                    <div class="card-body card-body-cascade text-left">
                        <p id="nombrePaciente"></p>
                        <p id="documentoPaciente"></p>
                        <p id="edadPaciente"></p>
                        <p id="tipoPaciente"></p>
                        <p id="aseguradora"></p>
                        <p id="fecha_creacion_registro"></p>
                    </div>
                </div>

                @if (session('Msj') == '!found')
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="alert-heading">Error!</h4>
                        <p>Paciente no encontrado, verifique el numero de documento.</p>
                    </div>
                @endif

                @if (session('Msj') == 'bad')
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="alert-heading">Error!</h4>
                        <p>Ha ocurrido un error al intentar guardar los datos.</p>
                    </div>
                @endif

                @if (session('Msj') == 'ok')
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="alert-heading">Exito!</h4>
                        <p>La fecha de programacion ha sido asignada.</p>
                    </div>
                @endif

                @if (session('Msj') == 'exists')
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="alert-heading">Advertencia!</h4>
                        <p>el paciente {{ session('paciente') }} ya se encuentra con una fecha de programacion asignada.</p>
                        <hr>
                        <p class="mb-0">Verificar el numero de documento</p>
                    </div>
                @endif

            </div>
        </div>

        <div class="card mt-3 mr-3">
            <div hidden id="div-formulario-programacion" class="card-body">
                <form id="formulario-programacion">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Acepta Visita</label>
                                <input type="hidden" id="paciente_id">
                                <input type="hidden" id="url_guardar-fecha_prgramacion" value="{{route('programacion.guardar')}}">
                                <select id="acepta_visita" class="custom-select">
                                    <option selected value="">Seleccione una opcion</option>
                                    <option value="SI">Si</option>
                                    <option value="NO">No</option>
                                    <option value="LLAMADA NO EXITOSA">Llamada no Exitosa</option>
                                    <option value="NO APLICA">No Aplica</option>
                                </select>
                                <small id="err-acepta_visita" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha de Programacion</label>
                                <input type="date" id="fecha_programacion" min="{{ date('Y-m-d') }}" class="form-control">
                                <small id="err-fecha_programacion" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Sitio de Toma de Muestra</label>
                                <select id="lugar_toma" class="custom-select">
                                    <option selected value="">Seleccione una opcion</option>
                                    <option value="CERCO">Cerco</option>
                                    <option value="DOMICILIO">Domicilio</option>
                                    <option value="CARCEL">Carcel</option>
                                </select>
                                <small id="err-lugar_toma" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Programa al que Pertenece</label>
                                <select id="nombre_programa" class="custom-select">
                                    <option selected value="">Seleccione una opcion</option>
                                    <option value="NO APLICA">No Aplica</option>
                                    <option value="NINGUNO">Ninguno</option>
                                    <option value="DE TODO CORAZON">De todo Corazón</option>
                                    <option value="VIH">Vih</option>
                                    <option value="AMARTE (ARTRITIS REUMATOIDES)">Amarte (artritis reumatoides)</option>
                                    <option value="RESPIRA (EPOC)">Respira (Epoc)</option>
                                    <option value="PROMOCION Y MANTENIMIENTO DE LA SALUD">Promocion y mantenimiento de la salud</option>
                                    <option value="MUJER SANA">Mujer Sana</option>
                                    <option value="OBESIDAD">Obesidad</option>
                                    <option value="GESTANTES">Gestantes</option>
                                </select>
                            <small id="err-nombre_programa" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-left">
                        <a id="guardar-fecha_programacion" class="btn btn-primary ml-0">Guardar Datos</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection