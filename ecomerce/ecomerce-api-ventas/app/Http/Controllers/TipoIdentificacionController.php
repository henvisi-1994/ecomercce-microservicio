<?php

namespace App\Http\Controllers;

use App\Models\TipoIdentificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoIdentificacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tipo_identificacionnes = TipoIdentificacion::all();
        return $tipo_identificacionnes;
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
        $validateData = $request->validate([
            'nombre_tipo_ident' => 'required|string|max:255',
            'estado_tipo_ident' => 'required|string|max:1',
        ]);
        TipoIdentificacion::create([
            'nombre_tipo_ident' => $validateData['nombre_tipo_ident'],
            'estado_tipo_ident' => $validateData['estado_tipo_ident'],
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
        DB::table('tipo_identificacion')
            ->where('id_tipo_ident', $id)
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
        $estado_tipo_ident = 'I';
        DB::table('tipo_identificacion')
            ->where('id_tipo_ident', $id)
            ->update(['estado_tipo_ident' => $estado_tipo_ident]);
        return;
    }
}
