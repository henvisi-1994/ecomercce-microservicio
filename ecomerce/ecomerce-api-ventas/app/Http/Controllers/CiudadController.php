<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CiudadController extends Controller
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
       $ciudades = DB::table('ciudad as c')
        ->join('provincia', 'c.id_provincia', '=', 'provincia.id_provincia')
        ->orderBy("c.id_ciudad","desc")
        ->get();
        return $ciudades;
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
            'nombre_ciudad' => 'required',
            'estado_ciudad' => 'required',
            'id_provincia' => 'required',
        ]);
        if ($v) {
            $ciudad = new Ciudad();
            $ciudad->nombre_ciudad = $request->input('nombre_ciudad');
            $ciudad->estado_ciudad = $request->input('estado_ciudad');
            $ciudad->id_provincia = $request->input('id_provincia');
            $ciudad->save();
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
        DB::table('ciudad')
            ->where('id_ciudad', $id)
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
        $estado_ciudad = 'I';
        DB::table('ciudad')
            ->where('id_ciudad', $id)
            ->update(['estado_ciudad' => $estado_ciudad]);
        return;
    }
}
