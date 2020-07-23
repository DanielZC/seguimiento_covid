@extends('layout.Layout')
@section('contenido')
<div class="jumbotron mt-4">
    <div class="row">
        <div class="col-md-4">
            <p class="text-success">Bienvenido: USUARIO</p>
            <img class="img-thumbnail" width="150em" src="/img/user.png" alt="">
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-1 text-center">
                        <strong>Cantidad de Pacientes Positivos</strong>
                    </h4>
                    <p class="text-center text-primary display-4">CANTIDAD_DE_PACIENTE</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection