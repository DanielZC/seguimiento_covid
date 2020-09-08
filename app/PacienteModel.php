<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;

class PacienteModel extends Model
{
    public function Listar()
    {
       $pacientes = DB::table('pacientes')->get();
       
       return $pacientes;
    }

    public function Crear($paciente)
    {
        $sql = DB::table('pacientes')->where('numero_documento', '=', $paciente->numero_documento)->count();

        if($sql == 0)
        {
            $sql = DB::table('pacientes')->insert([
                'tipo_paciente' => $paciente->tipo_paciente,
                'numero_documento' => $paciente->numero_documento,
                'tipo_documento' => $paciente->tipo_documento,
                'primer_nombre' => $paciente->primer_nombre,
                'segundo_nombre' => $paciente->segundo_nombre,
                'primer_apellido' => $paciente->primer_apellido,
                'segundo_apellido' => $paciente->segundo_apellido,
                'edad' => $paciente->edad,
                'unidad_medida' => $paciente->unidad_medida,
                'sexo' => $paciente->sexo,
                'municipio' => $paciente->municipio,
                'barrio' => $paciente->barrio,
                'telefono' => $paciente->telefono,
                'telefono2' => $paciente->telefono2,
                'correo' => $paciente->correo,
                'aseguradora' => $paciente->aseguradora,
                'regimen' => 'SUBSIDIADO',
                'fecha_programacion_recepcion' => $paciente->fecha_prog_recep .' '. date('h:i:s'),
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
        }
        else
        {
            $result = 'duplicated';
        }

        return $result;
    }
}
