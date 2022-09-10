<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BodegaController extends Controller
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
        $bodegas = DB::table('bodega as b')
            ->join('direccion', 'b.id_direccion', '=', 'direccion.id_direccion')
            ->join('ciudad', 'b.id_ciudad', '=', 'ciudad.id_ciudad')
            ->orderBy('b.id_bod', 'desc')
            ->get();
        return $bodegas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'nombre_bod' => 'required',
            'id_direccion' => 'required',
            'telef_bod' => 'required',
            'cel_bod' => 'required',
            'estado_bod' => 'required',
            'nomb_contac_bod' => 'required',
            'fechaini_bod' => 'required',
            'fechafin_bod' => 'required',
        ]);
        if ($v) {
            $bodegas = new Bodega();
            $bodegas->id_ciudad = $request->input('id_ciudad');
            $bodegas->nombre_bod = $request->input('nombre_bod');
            $bodegas->id_direccion = $request->input('id_direccion');
            $bodegas->telef_bod = $request->input('telef_bod');
            $bodegas->cel_bod = $request->input('cel_bod');
            $bodegas->estado_bod = $request->input('estado_bod');
            $bodegas->nomb_contac_bod = $request->input('nomb_contac_bod');
            $bodegas->fecha_inicio = $request->input('fechaini_bod');
            $bodegas->fecha_fin = $request->input('fechafin_bod');
            $bodegas->save();
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
        $v = $this->validate(request(), [
            'nombre_bod' => 'required',
            'id_direcion' => 'required',
            'telef_bod' => 'required',
            'cel_bod' => 'required',
            'estado_bod' => 'required',
            'nomb_contac_bod' => 'required',
            'fechaini_bod' => 'required',
            'fechafin_bod' => 'required',
        ]);
        if ($v) {
            $id_ciudad = $request->input('id_ciudad');
            $nombre_bod = $request->input('nombre_bod');
            $id_direcion = $request->input('id_direcion');
            $telef_bod = $request->input('telef_bod');
            $cel_bod = $request->input('cel_bod');
            $estado_bod = $request->input('estado_bod');
            $nomb_contac_bod = $request->input('nomb_contac_bod');
            $fechaini_bod = $request->input('fechaini_bod');
            $fechafin_bod = $request->input('fechafin_bod');
            DB::table('bodega')
                ->where('id_bod', $id)
                ->update([
                    'nombre_bod' => $nombre_bod,
                    'id_direcion' => $id_direcion,
                    'telef_bod' => $telef_bod,
                    'cel_bod' => $cel_bod,
                    'estado_bod' => $estado_bod,
                    'nomb_contac_bod' => $nomb_contac_bod,
                    'fechaini_bod' => $fechaini_bod,
                    'fechafin_bod' => $fechafin_bod,
                    'id_ciudad' => $id_ciudad,
                ]);
            return;
        } else {
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
        $estado_bod = 'I';
        DB::table('bodega')
            ->where('id_bod', $id)
            ->update(['estado_bod' => $estado_bod]);
        return;
    }
}
