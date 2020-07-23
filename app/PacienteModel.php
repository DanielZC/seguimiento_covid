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
                'primer_nombre' => $paciente->primer_nombre,
                'segundo_nombre' => $paciente->segundo_nombre,
                'primer_apellido' => $paciente->primer_apellido,
                'segundo_apellido' => $paciente->segundo_apellido,
                'edad' => $paciente->edad,
                'unidad_medida' => $paciente->unidad_medida,
                'sexo' => $paciente->sexo,
                'telefono' => $paciente->telefono,
                'aseguradora' => $paciente->aseguradora,
                'tipo_documento' => $paciente->tipo_documento,
                'barrio' => $paciente->barrio,
                'numero_documento' => $paciente->numero_documento,
                'correo' => $paciente->correo,
                'fecha_prog_recep' => $paciente->fecha_prog_recep,
                'fecha_registro' => date('Y-m-d h:i:s'),
                'municipio' => $paciente->municipio
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
