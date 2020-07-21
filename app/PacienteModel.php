<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PacienteModel extends Model
{
    public function Listar()
    {
       $pacientes = DB::table('pacientes')->get(); 
       return $pacientes;
    }
}
