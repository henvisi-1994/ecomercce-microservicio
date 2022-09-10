<?php

namespace App\Http\Controllers;

use App\Models\Direcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirecionController extends Controller
{
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $direciones = DB::table('direccion as d')
        ->join('ciudad', 'd.id_ciudad', '=', 'ciudad.id_ciudad')
        ->orderBy("d.id_direccion","desc")
        ->get();
        return $direciones;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = $this->validate(request(), [
            'direcion' => 'required',
            'estado_direccion' => 'required',
            'id_ciudad' => 'required',
        ]);
        if ($v) {
            $direccion = new Direcion();
            $direccion->direcion = $request->input('direcion');
            $direccion->calle = $request->input('calle');
            $direccion->numero = $request->input('numero');
            $direccion->piso = $request->input('piso');
            $direccion->telefono = $request->input('telefono');
            $direccion->movil = $request->input('movil');
            $direccion->estado_direccion = $request->input('estado_direccion');
            $direccion->id_ciudad	 = $request->input('id_ciudad');
            $direccion->save();
            return;
        } else {
            return back()->withInput($request->all());
        }
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
        DB::table('direccion')
        ->where('id_direccion', $id)
        ->update($request->all());
    return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estado_direccion = 'I';
        DB::table('direccion')
            ->where('id_direccion', $id)
            ->update(['estado_direccion' => $estado_direccion]);
        return;
    }
}
