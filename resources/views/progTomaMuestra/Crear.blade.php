@extends('layout.Layout')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="card col-sm-6">
                <div class="card-body">
                    <h4>Programacion de pacientes para la toma de muestra</h4>
                    <hr>
                    <form action="{{ route('programacion.buscarPaciente') }}" method="POST">
                        <div class="form-group">
                            @csrf
                            <label>Ingrese numero de identificacion</label>
                            <input type="text" name="numero_documento" class="form-control">
                            <small class="text-danger">{{ $errors->info->first('numero_documento') }}</small>
                        </div>
                        <input type="submit" value="Buscar" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                @isset($infoPaciente)
                    @foreach ($infoPaciente as $paciente)
                        <div class="card card-cascade">
                            <div class="view view-cascade gradient-card-header blue-gradient">
                                <h2 class="card-header-title mb-3 mt-2 text-center text-white">
                                    {{ $paciente->primer_nombre .' '. $paciente->primer_apellido .' '. $paciente->segundo_apellido }}
                                </h2>
                            </div>
                            <div class="card-body card-body-cascade text-left">
                                <p><strong>Documento de identidad:</strong>  {{ $paciente->tipo_documento .' - '. $paciente->numero_documento}}</p>
                                <p><strong>Edad:</strong>  {{ $paciente->edad .' '. $paciente->unidad_medida}}</p>
                                <p><strong>Tipo de paciente:</strong>  {{ $paciente->tipo_paciente }}</p>
                                <p><strong>aseguradora:</strong>  {{ $paciente->aseguradora }}</p>
                                <p><strong>Fecha de registro:</strong>  {{ $paciente->fecha_registro }}</p>
                            </div>
                        </div>
                    @endforeach
                @endisset

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

        @isset($infoPaciente)
            <div class="card mt-3 mr-3">
                <div class="card-body">
                    <form action="{{ route('programacion.guardar') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Acepta Visita</label>
                                    <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                                    <select name="acepta_visita" class="custom-select">
                                        <option selected value=""> </option>
                                        <option value="SI">Si</option>
                                        <option value="NO">No</option>
                                        <option value="LLAMADA NO EXITOSA">Llamada no Exitosa</option>
                                        <option value="NO APLICA">No Aplica</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha de Programacion</label>
                                    <input type="date" name="fecha_programacion" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Sitio de Toma de Muestra</label>
                                    <select name="programacion_atencion" class="custom-select">
                                        <option selected value=""> </option>
                                        <option value="CERCO">Cerco</option>
                                        <option value="DOMICILIO">Domicilio</option>
                                        <option value="CARCEL">Carcel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Programa al que Pertenece</label>
                                    <select name="nombre_programa" class="custom-select">
                                        <option selected value=""> </option>
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
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-left">
                            <input type="submit" value="Guardar Datos" class="btn btn-primary ml-0">
                        </div>
                    </form>
                </div>
            </div>
        @endisset
    </div>
@endsection