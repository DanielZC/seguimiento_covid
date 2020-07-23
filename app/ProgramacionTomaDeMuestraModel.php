<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProgramacionTomaDeMuestraModel extends Model
{
    public function Crear($programacion)
    {
        $sql = DB::table('prog_toma_muestra')->insert([

        ]);
    }

    public function Buscar($pacienteInfo)
    {
        $sql = DB::table('pacientes')->where('numero_documento', '=', $pacienteInfo->numero_documento)->get();
        
        if ($sql->count() > 0) 
        {
            $result = $sql;
        }
        else
        {
            $result = '!found';
        }

        return $result;
    }
}
