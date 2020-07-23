<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProgramacionTomaDeMuestraModel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProgramacionTomaDeMuestraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('progTomaMuestra.Crear');
    }

    /**
     * busca a un paciente por numero de identificacion.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'numero_documento' =>  'required | numeric'
        ]);

        if ($validator->fails()) 
        {
            return redirect()->route('programacion.crear')->withErrors($validator, 'info')->withInput();
        }

        $programacionModel = new ProgramacionTomaDeMuestraModel;
        $result = $programacionModel->Buscar($request);

        $mjs = array('!found','exists');

        if(!in_array($result['mensaje'],$mjs))
        {
            return view('progTomaMuestra.Crear', ['infoPaciente' => $result['paciente']]);
        }
        else
        {
            return redirect()->route('programacion.crear')->with('Msj', $result['mensaje'])->with('paciente', $result['paciente']);
        }

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
            'paciente_id' => 'required | numeric',
            'acepta_visita' => 'required | string',
            'fecha_programacion' => 'required | date',
            'programacion_atencion' => 'required | string',
            'nombre_programa' => 'required | string',
        ]);

        if($validator->fails())
        {
            return redirect()->route('programacion.crear')->withErrors('programacion',$validator)->withInput();
        }
        
        $programacionModel = new ProgramacionTomaDeMuestraModel;
        $result = $programacionModel->Crear($request);

        return redirect()->route('programacion.crear')->with('Msj',$result);
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
