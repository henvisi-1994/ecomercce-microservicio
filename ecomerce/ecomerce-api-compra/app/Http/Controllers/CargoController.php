<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
{
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $usuarios = Cargo::all();
        return $usuarios;
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
            'id_emp' => 'required',
            'nomb_cargo' => 'required|string|max:255',
            'observ_cargo' => 'required|string|max:255',
            'estado_cargo' => 'required|string|max:1',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ]);
        Cargo::create([
            'id_emp' => $validateData['id_emp'],
            'nomb_cargo' => $validateData['nomb_cargo'],
            'observ_cargo' => $validateData['observ_cargo'],
            'estado_cargo' => $validateData['estado_cargo'],
            'fecha_inicio' => $validateData['fecha_inicio'],
            'fecha_fin' => $validateData['fecha_fin'],
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
        Cargo::where('id_cargo', $id)
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
        $estado_cargo = 'I';
        DB::table('cargo')
            ->where('id_cargo', $id)
            ->update(['estado_cargo' => $estado_cargo]);
        return;
    }
}
