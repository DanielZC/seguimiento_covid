@extends('layout.Layout')
@section('contenido')
<div class="container">
    <div class="row">
        <h3 class="titulo">Ingrese los Datos del Paciente</h3>
    </div>
</div>

<div class="container">
    {{-- Alertas --}}

    @if (session('Msj') == 'duplicated')
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Numero de documento duplicado!</strong> El numero de documento ya registrado a nombre de otro paciente
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('Msj') == 'ok')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Datos Guardados!</strong> Paciente registrado con exito
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('Msj') == 'bad')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Ha ocurrido un error al guardar los datos del paciente
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    {{-- fin alertas --}}

    {{-- Formulario de registro de pacientes --}}
    <form action="{{ route('paciente.guardar') }}" method="POST">
        <div class="row">
            <div class="col-sm-3">
                @csrf
                <label class="col-form-label">Tipo de Paciente:</label>
                <select name="tipo_paciente" class="custom-select">
                    <option selected value="{{ old('tipo_paciente') }}">{{ old('tipo_paciente') }}</option>
                    <option value="CASO INDICE">CASO INDICE</option>
                    <option value="CONTACTO ESTRECHO">CONTACTO ESTRECHO</option>
                </select>
                <small class="text-danger">{{ $errors->paciente->first('tipo_paciente')}}</small>
                <br>
            </div>

            <div class="col-sm-3">
                <input type="hidden" name="id_usuario" value="">
                <label class="col-form-label">Primer Nombre:</label>
                <input type="text" name="primer_nombre" class="form-control" value="{{ old('primer_nombre') }}" placeholder="Primer Nombre">
                <small class="text-danger">{{ $errors->paciente->first('primer_nombre')}}</small>
            </div>

            <div class="col-sm-3">
                <label class="col-form-label">Segundo Nombre:</label>
                <input type="text" name="segundo_nombre" class="form-control" value="{{ old('segundo_nombre') }}" placeholder="Segundo Nombre">
                <small class="text-danger">{{ $errors->paciente->first('segundo_nombre')}}</small>
            </div>

            <div class="col-sm-3">
                <label class="col-form-label">Primer Apellido:</label>
                <input type="text" name="primer_apellido" class="form-control" value="{{ old('primer_apellido') }}" placeholder="Primer Apellido">
                <small class="text-danger">{{ $errors->paciente->first('primer_apellido')}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label class="col-form-label">Segundo Apellido:</label>
                <input type="text" name="segundo_apellido" class="form-control" value="{{ old('segundo_apellido') }}" placeholder="Segundo Apellido">
                <small class="text-danger">{{ $errors->paciente->first('segundo_apellido')}}</small>
            </div>


            <div class="col-sm-3">
                <label class="col-form-label">Digite su Edad:</label>
                <input type="number" name="edad" class="form-control" value="{{ old('edad') }}" placeholder="">
                <small class="text-danger">{{ $errors->paciente->first('edad')}}</small>
            </div>

            <div class="col-sm-3">
                <label class="col-form-label">Unidad de Medida:</label>
                <select name="unidad_medida" class="custom-select">
                    <option selected value="{{ old('unidad_medida') }}">{{ old('unidad_medida') }}</option>
                    <option value="AÑOS">AÑOS</option>
                    <option value="MESES">MESES</option>
                    <option value="DIAS">DIAS</option>
                </select>
                <small class="text-danger">{{ $errors->paciente->first('unidad_medida')}}</small>
            </div>

            <div class="col-sm-3">
                <label class="col-form-label">Sexo:</label>
                <select name="sexo" class="custom-select">
                    <option selected value="{{ old('sexo') }}">{{ old('sexo') }}</option>
                    <option value="MASCULINO">MACULINO</option>
                    <option value="FEMENINO">FEMENINO</option>
                </select>
                <small class="text-danger">{{ $errors->paciente->first('sexo')}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label class="col-form-label">Numero de Telefono:</label>
                <input type="number" name="telefono" class="form-control" value="{{ old('telefono') }}" placeholder="Celular">
                <small class="text-danger">{{ $errors->paciente->first('telefono')}}</small>
            </div>

            <div class="col-sm-3">
                <label class="col-form-label">Aseguradora o EPS:</label>
                <input type="text" name="aseguradora" class="form-control" value="{{ old('aseguradora') }}" placeholder="Escriba su EPS">
                <small class="text-danger">{{ $errors->paciente->first('aseguradora')}}</small>
            </div>

            <div class="col-sm-3">
                <label class="col-form-label">Seleccione el tipo de documento:</label>
                <select name="tipo_documento" class="custom-select">
                    <option selected value=""></option>
                    <option value="CC">CEDULA DE CIUDADANIA</option>
                    <option value="TI">TARJETA DE INDENTIDAD</option>
                    <option value="RC">REGISTRO CIVIL</option>
                    <option value="CE">CEDULA EXTRANJERA</option>
                </select>
                <small class="text-danger">{{ $errors->paciente->first('tipo_documento')}}</small>
            </div>

            <div class="col-sm-3">
                <label class="col-form-label">Numero Documento:</label>
                <input type="number" name="numero_documento" class="form-control" value="{{ old('numero_documento') }}" placeholder="">
                <small class="text-danger">{{ $errors->paciente->first('numero_documento')}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label class="col-form-label">Barrio y direccion Completa:</label>
                <input type="text" name="barrio" class="form-control" value="{{ old('barrio') }}" placeholder="ejemplo: Campestre mz:7 lt: 12">
                <small class="text-danger">{{ $errors->paciente->first('barrio')}}</small>
            </div>

            <div class="col-sm-3">
                <label class="col-form-label">Email:</label>
                <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" placeholder="Correo Electronico">
                <small class="text-danger">{{ $errors->paciente->first('correo')}}</small>
            </div>

            <div class="col-sm-3">
                <label class="col-form-label">Fecha De Recepcion de Informacion</label>
                <input type="date" name="fecha_prog_recep" class="form-control" value="{{ old('fecha_prog_recep') }}">
                <small class="text-danger">{{ $errors->paciente->first('fecha_prog_recep')}}</small>
            </div>

            <div class="col-sm-3">
                <label>Municipio</label>
                <select name="municipio" class="custom-select">
                    <option selected value="{{ old('municipio') }}">{{ old('municipio') }}</option>
                    @foreach ($Municipios as $Municipio => $value)
                        <option value="{{ strtoupper($value) }}">{{ ucwords($value) }}</option>
                    @endforeach
                </select>
                <small class="text-danger">{{ $errors->paciente->first('municipio')}}</small>
            </div>
        </div>
    </form>
    <div class="row mt-3">
        <div class="col-sm-3">
            <input type="submit" class="btn btn-outline-secondary btn-lg" value="Guardar Datos">
        </div>
        
        {{-- <div class="col-sm-3">
            <a href="index.php" class="btn btn-outline-secondary btn-lg">regresar</a> 
        </div> --}}
    </div>
</div>
@endsection