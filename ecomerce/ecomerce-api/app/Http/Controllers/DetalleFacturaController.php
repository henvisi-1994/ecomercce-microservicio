<?php

namespace App\Http\Controllers;

use App\Models\DetalleFactura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetalleFacturaController extends Controller
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
    public function store(Request $request, $num_fact)
    {
        $idFactura = DB::table('factura as fac')
            ->select('id_fact')
            ->where('num_fact', '=', $num_fact)
            ->first();
        $detalleFact = new DetalleFactura();
        $detalleFact->id_fact = $idFactura->id_fact;
        $detalleFact->id_prod = $request->input('id_prod');
        $detalleFact->cantidad = $request->input('cantidad');
        $detalleFact->descripcion = $request->input('descripcion');
        $detalleFact->precio_prod = $request->input('precio_prod');
        $detalleFact->descuento = $request->input('descuento');
        $detalleFact->neto = $request->input('neto');
        $detalleFact->iva = $request->input('iva');
        $detalleFact->total = $request->input('total');
        $detalleFact->save();
        return;
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
