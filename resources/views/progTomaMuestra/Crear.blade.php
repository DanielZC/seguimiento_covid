@extends('layout.Layout')
@section('contenido')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4>Programacion de pacientes para la toma de muestra</h4>
                <hr>
                <div class="row">
                    <div class="col-sm-4">
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
                    <div class="col-sm-8">
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

                        @if (session('Msj'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> Paciente no encontrado, verifique el numero de documento
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        @isset($infoPaciente)    
            <div class="card mt-3">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-sm-3">
                            
                            </div>
                            <div class="col-sm-3">

                            </div>
                            <div class="col-sm-3">

                            </div>
                            <div class="col-sm-3">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endisset
    </div>
@endsection