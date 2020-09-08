<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProgramacionTomaDeMuestraModel extends Model
{
    public function Crear($programacion)
    {
        $sql = DB::table('programaciones_toma_muestras')->insert([
            'paciente_id' => $programacion->paciente_id,
            'acepta_visita' => $programacion->acepta_visita,
            'fecha_programacion' => $programacion->fecha_programacion .' '. date('h:i:s'),
            'programa_pertenece' => $programacion->nombre_programa,
            'lugar_toma' => $programacion->lugar_toma,
            'fecha_creacion_registro' => date('Y-m-d h:i:s')
        ]);

        if($sql)
        {
            $result = 'ok';
        }
        else
        {
            $result = 'bad';
        }      

        return $result;
    }

    public function Buscar($pacienteInfo)
    {
        $result = '';
        $msj = '';

        $paciente = DB::table('pacientes')->where('numero_documento', '=', $pacienteInfo->numero_documento)->get();
        
        foreach ($paciente as $pacienteInfo){}

        if ($paciente->count() != 0) 
        {
            $sqlC = DB::table('programaciones_toma_muestras')->where([
                ['paciente_id', '=', $pacienteInfo->id_paciente],
                ['estado_proceso', '=', 'ACTIVO']
            ])->count();

            if($sqlC == 0)
            {
                $result = $paciente;
            }
            else
            {
                $programacion = DB::table('programaciones_toma_muestras')
                ->select(DB::raw('DATE(programaciones_toma_muestras.fecha_programacion) AS fecha_programacion'))
                ->where([
                    ['paciente_id', '=', $pacienteInfo->id_paciente],
                    ['estado_proceso', '=', 'ACTIVO']
                ])->get();

                foreach ($programacion as $programacionInfo) {}

                $result = [
                    $pacienteInfo->primer_nombre .' '. $pacienteInfo->primer_apellido .' '. $pacienteInfo->segundo_apellido,
                    $programacionInfo->fecha_programacion
                ];
                $msj = 'exists';
            }
        }
        else
        {
            $msj = '!found';
            $result = $pacienteInfo->numero_documento;
        }

        return ['data' => $result, 'mensaje' => $msj];
    }

    public function BuscarPacienteFR($paciente)
    {

        $pacienteInfo = DB::table('pacientes')
        ->select(
            'id_paciente',
            'primer_nombre',
            'primer_apellido',
            'segundo_apellido'
        )
        ->where('numero_documento', '=', $paciente->numero_documento)
        ->get();

        if($pacienteInfo->count() > 0)
        {
            $id_paciente = $pacienteInfo[0]->id_paciente;
            $validator = DB::table('programaciones_toma_muestras')->where('paciente_id', '=', $id_paciente)->count();
            
            if($validator == 1)
            {
                $pacienteFP = DB::table('programaciones_toma_muestras')
                ->rightJoin('pacientes', 'pacientes.id_paciente', '=', 'programaciones_toma_muestras.paciente_id')
                ->select(
                    'id_paciente',
                    'numero_documento',
                    'tipo_documento',
                    'primer_nombre',
                    'primer_apellido',
                    'segundo_apellido',
                    'edad',
                    'unidad_medida',
                    DB::raw('DATE(programaciones_toma_muestras.fecha_programacion) AS fecha_programacion')
                )
                ->where('paciente_id', '=', $id_paciente)
                ->whereNull('fecha_realizacion_toma')
                ->get();

                if($pacienteFP->count() == 1)
                {
                    $result = ['mensaje' => 'ok', 'data' => $pacienteFP];
                }
                else
                {
                    $paciente = $pacienteFP;
                    $result = ['mensaje' => 'existFR', 'data' => $pacienteInfo];
                }
            }
            else
            {
                $result = '!exists';
            }
        }
        else
        {
            $result = '!found';
        }

        return $result;  
    }

    public function IngresarFechaRealizacion($realizacionToma)
    {
        $sql = DB::table('programaciones_toma_muestras')
        ->where('paciente_id', $realizacionToma->paciente_id)
        ->update([
            'visita_exitosa' => $realizacionToma->visita_exitosa,
            'fecha_realizacion_toma' => $realizacionToma->fecha_realizacion .' '. date('h:i:s'),
            'motivo' => $realizacionToma->motivo,
            'tipo_prueba' => $realizacionToma->tipo_prueba,
            'observacion' => $realizacionToma->observacion,
            'fecha_creacion_registro' => date('Y-m-d h:i:s')
        ]);

        if($sql)
        {
            $result = 'ok';
        }
        else
        {
            $result = 'bad';
        }      

        return $result;
    }
}
