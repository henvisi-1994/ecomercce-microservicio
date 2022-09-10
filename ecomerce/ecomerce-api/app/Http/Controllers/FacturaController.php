<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
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
        //
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
        $id_usuario=$request->input('id_usu');
        $v = $this->validate(request(), [
            'num_fact' => ['required', 'string'],
            'id_formapago' => ['required'],
        ]);
        if ($v) {
            $factura = new Factura();
            $factura->id_formapago = $request->input('id_formapago');
            $factura->id_per = $request->input('id_per');
            $factura->num_fact = $request->input('num_fact');
            $factura->fecha_emision_fact = $request->input(
                'fecha_emision_fact'
            );
            $factura->hora_emision_fact = $request->input('hora_emision_fact');
            $factura->estado_fact = $request->input('estado_fact');
            $factura->observ_fact = $request->input('observ_fact');
            $factura->subtotal_fact = $request->input('subtotal_fact');
            $factura->subcero_fact = $request->input('subcero_fact');
            $factura->subiva_fact = $request->input('subiva_fact');
            $factura->subice_fact = $request->input('subice_fact');
            $factura->total_fact = $request->input('total_fact');
            $factura->save();
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
