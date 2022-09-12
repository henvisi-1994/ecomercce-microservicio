<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarcaController extends Controller
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
        $marcas = Marca::get();
        return $marcas;
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

            'nomb_marca' => 'required',
            'observ_marca' => 'required',
            'estado_marca' => 'required',
        ]);
        if ($v) {
            $marca = new Marca();
            $marca->id_marca = $request->input('id_marca');
            $marca->nomb_marca = $request->input('nomb_marca');
            $marca->observ_marca = $request->input('observ_marca');
            $marca->estado_marca = $request->input('estado_marca');
            $marca->save();
            return response()->json([
                'mensaje' => "Registro de Marca Exitoso"
            ]);
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
        $nomb_marca = $request->input('nomb_marca');
        $estado_marca = $request->input('estado_marca');
        $observ_marca = $request->input('observ_marca');
        DB::table('marca')
            ->where('id_marca', $id)
            ->update(
                ['nomb_marca' => $nomb_marca, 'estado_marca' => $estado_marca, 'observ_marca' => $observ_marca]
            );
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
        $estado_marca = 'I';
        DB::table('marca')
            ->where('id_marca', $id)
            ->update(
                ['estado_marca' => $estado_marca]
            );
        return;
    }
}
