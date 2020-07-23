<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProgramacionTomaDeMuestraModel extends Model
{
    public function Crear($programacion)
    {
        $sql = DB::table('prog_toma_muestra')->insert([
            'pacientes_id' => $programacion->paciente_id,
            'acepta_visita' => $programacion->acepta_visita,
            'fecha_programacion' => $programacion->fecha_programacion .' '. date('h:i:s'),
            'programacion_atencion' =>$programacion->programacion_atencion,
            'programa_pertenece' =>$programacion->nombre_programa
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
            $sql = DB::table('prog_toma_muestra')->where('pacientes_id', '=', $pacienteInfo->id)->count();

            if($sql == 0)
            {
                $result = $paciente;
            }
            else
            {
                $result = $pacienteInfo->primer_nombre .' '. $pacienteInfo->primer_apellido .' '. $pacienteInfo->segundo_apellido;
                $msj = 'exists';
            }
        }
        else
        {
            $msj = '!found';
        }

        return ['paciente' => $result, 'mensaje' => $msj];
    }
}
