<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class EmpleadoController extends Controller
{
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('secretKey');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $empleados = Empleado::orderBy('id_empleado', 'desc')->with('cargo')
       ->get();
        foreach ($empleados as $empleado) {
            $empleado->persona = $this->obtenerPersona($empleado->id_persona);
        }
         return response()->json($empleados);

    }


    public function obtenerPersona($id_per)
    {
        $persona = Http::withHeaders(['Authorization' => config('services.ventas.secret')])
            ->get('http://localhost:8001/api/persona/' . $id_per)->json();
        return $persona;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $empleado = new Empleado();
            $empleado->id_empresa = $request->id_empresa;
            $empleado->id_cargo = $request->id_cargo;
            $empleado->estado_empl = $request->estado_empl;
            $empleado->id_persona = $request->id_persona;
            $empleado->id_usu = $request->id_usu;
            $empleado->save();
            return response()->json([
        'mensaje' => 'Empleado registrado con exito'
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
        $empleado = Empleado::where('id_empleado', $id)
        ->orwhere('id_usu', $id)
        ->first();
        return $empleado;
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
       $id_empresa  =  $request->input('id_empresa');
        $id_usu  =  $request->input('id_usu');
        $id_cargo  =  $request->input('id_cargo');
        $id_persona  =  $request->input('id_persona');
        $estado_empl  =  $request->input('estado_empl');
        $id_usu= $request->input('id_usu');
        DB::table('empleado')
            ->where('id_empleado', $id)
            ->update(['id_empresa'=>$id_empresa,'id_usu'=>$id_usu,'id_cargo'=>$id_cargo,'id_persona'=>$id_persona,'estado_empl'=>$estado_empl]);
        return response()->json([
            'mensaje' => 'Empleado actualizado con exito'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estado_empl = 'I';
        DB::table('empleado')
            ->where('id_empleado', $id)
            ->update(['estado_empl' => $estado_empl]);
        return;
    }

}
