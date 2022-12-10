<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinciaController extends Controller
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
        $provincias = DB::table('provincia as p')
        ->join('pais', 'p.id_pais', '=', 'pais.id_pais')
        ->orderBy("p.id_provincia","desc")
        ->get();
        return $provincias;
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
         $v =$this->validate(request(), [
            'nombre_provincia' => 'required',
            'estado_prov' => 'required'
        ]);
        if ($v)
        {
            $provincias= new Provincia();
            $provincias->nombre_provincia = $request->nombre_provincia;
            $provincias->id_pais = $request->id_pais;
            $provincias->estado_prov = $request->estado_prov;
            $provincias->save();
            return;
        }
        else
        {
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
        $v =$this->validate(request(), [
            'nombre_provincia' => 'required',
            'estado_prov' => 'required'
        ]);
        if ($v)
        {
            DB::table('provincia')
            ->where('id_provincia', $id)
            ->update($request->all() );
        return;
      }
      else
        {
          return back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estado_prov= 'I';
        DB::table('provincia')
            ->where('id_provincia', $id)
            ->update(['estado_prov' => $estado_prov]
          );
        return;
    }
}
