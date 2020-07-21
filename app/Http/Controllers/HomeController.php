<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PacienteModel;

class HomeController extends Controller
{
    public function Index()
    {
        $pacientes = new PacienteModel;
        return $pacientes->Listar();
    }
}
