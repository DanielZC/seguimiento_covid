@extends('layout.Layout')
@section('contenido')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="table-wrapper-scroll-y my-custom-scrollbar table-hover">
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr class="text-right ">
                            <th class="text-center th-sm">Nombre paciente</th>
                            <th class="text-center th-sm">Edad</th>
                            <th class="text-center th-sm">Identificacion</th>
                            <th class="text-center th-sm">Telefono</th>
                            <th class="text-center th-sm">Fecha de Creacion</th>
                        </tr>
                    </thead>
                    <tbody id="tbl-llamadas">
                        @foreach ($pacientes as $paciente)
                            
                            <tr>
                                <td class="text-center">{{ ucwords($paciente->primer_nombre .' '. $paciente->primer_apellido . ' '. $paciente->segundo_apellido) }}</td>
                                <td class="text-center">{{ $paciente->edad .' '. $paciente->unidad_medida }}</td>
                                <td class="text-center">{{ $paciente->tipo_documento .' - '. $paciente->numero_documento }}</td>
                                <td class="text-center">{{ $paciente->telefono }}</td>
                                <td class="text-center">{{ $paciente->fecha_registro }}</td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">Nombre paciente</th>
                            <th class="text-center">Edad</th>
                            <th class="text-center">Identificacion</th>
                            <th class="text-center">Telefono</th>
                            <th class="text-center">Fecha de Creacion</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection