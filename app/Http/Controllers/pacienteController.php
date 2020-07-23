<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PacienteModel;
use Illuminate\Support\Facades\Validator;

class pacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = new PacienteModel;
        $Pacientes = $pacientes->Listar();
        
        return view('paciente.Listar', ['pacientes' => $Pacientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
        $municipios = [
            'cartagena',
            'Santa catalina',
            'Clemencia',
            'Turbana',
            'Turbaco',
            'Arjona',
            'Mahates',
            'Villa nueva',
            'Maria la baja',
            'San jacinto',
            'El carmen de bolivar',
            'San juan nepomuceno',
            'Zambrano',
            'Calamar',
            'Santa Rosa',
            'San estanislao',
            'San cristobal',
            'Sopla viento',
            'El guamo',
            'Arroyohondo',
            'Cordoba'
        ];

        return view('paciente.Crear', ['Municipios' => $municipios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'tipo_paciente' => 'required',
            'primer_nombre' => 'required | min:4 | max:50',
            'segundo_nombre' => 'min:4 | string',
            'primer_apellido' => 'required | min:4 | max:50',
            'segundo_apellido' => 'min:4 | max:50',
            'edad' => 'required | max:3 | numeric',
            'unidad_medida' => 'required',
            'sexo' => 'required',
            'telefono' => 'required | numeric',
            'aseguradora' => 'required',
            'tipo_documento' => 'required',
            'barrio' => 'required',
            'numero_documento' => 'required | numeric',
            'correo' => 'required | email',
            'fecha_prog_recep' => 'required | date',
            'municipio' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->route('paciente.crear')->withErrors($validator, 'paciente')->withInput();
        }
        
        $pacienteModel = new PacienteModel();
        $result = $pacienteModel->Crear($request);

        return redirect()->route('paciente.crear')->with('Msj',$result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
