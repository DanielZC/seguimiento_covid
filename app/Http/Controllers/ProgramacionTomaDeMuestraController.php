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

    public function fechaRealizacion(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'numero_documento' => 'required | numeric'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ]);
        }

        $programacionModel = new ProgramacionTomaDeMuestraModel;
        $result = $programacionModel->BuscarPacienteFR($request);

        $msj = array('!found','exists','bad','existFR');

        if(!in_array($result['mensaje'],$msj))
        {
            return response()->json([
                'status' => 'ok',
                'data' => $result['data']
            ]);
        }
        else
        {
            return response()->json([
                'status' => $result['mensaje'],
                'data' => $result['data']
            ]);
        }
    }

    public function ingresarFechaRealizacion(Request $request)
    {
        if($request->visita_exitosa == 'No')
        {
            $validator = Validator::make($request->all(),[
                'visita_exitosa' => 'required',
                'fecha_realizacion' => 'required | date',
                'motivo' => 'required',
                'paciente_id' => 'required | numeric'
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status' => 'error',
                    'error' => $validator->errors()
                ]);
            }
            else
            {
                $programacionModel = new ProgramacionTomaDeMuestraModel;
                $result = $programacionModel->IngresarFechaRealizacion($request);

                if($result == 'ok')
                {
                    return response()->json([
                        'status' => 'ok'
                    ]);
                }
                else
                {
                    return response()->json([
                        'status' => 'bad'
                    ]);

                }
                
            }            
        }
    
        $validator = Validator::make($request->all(),[
            'visita_exitosa' => 'required',
            'fecha_realizacion' => 'required | date',
            'tipo_prueba' => 'required',
            'paciente_id' => 'required | numeric'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ]);
        }

        $programacionModel = new ProgramacionTomaDeMuestraModel;
        $result = $programacionModel->IngresarFechaRealizacion($request);

        if($result)
        {
            return response()->json([
                'status' => 'ok'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'bad'
            ]);
        }
    }

    public function buscarPacienteIngresarResultado(Request $request)
    {
        return response()->json([
            'status' => 'ok',
            'data' => $request->all()
        ]);
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
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ]);
        }

        $programacionModel = new ProgramacionTomaDeMuestraModel;
        $result = $programacionModel->Buscar($request);

        $msj = array('!found','exists');

        if(in_array($result['mensaje'],$msj))
        {
            return response()->json([
                'status' => $result['mensaje'],
                'data' => $result
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'ok',
                'data' => $result
            ]);
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
            'lugar_toma' => 'required | string',
            'nombre_programa' => 'required | string' 
        ]);
  
        
        if($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ]);
        }

        $programacionModel = new ProgramacionTomaDeMuestraModel;
        $result = $programacionModel->Crear($request);

        return response()->json([
            'status' => 'ok',
            'data' => ''
        ]);
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
