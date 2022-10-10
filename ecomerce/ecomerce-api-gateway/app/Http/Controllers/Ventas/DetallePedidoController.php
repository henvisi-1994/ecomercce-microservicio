<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Services\Ventas\DetallePedidoService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    use ApiResponser;
    public $detalle_pedido_service;
    public function __construct(DetallePedidoService $detallePedidoService)
    {
        $this->detalle_pedido_service = $detallePedidoService;
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
        return $this->successResponse($this->detalle_pedido_service->store($request->all()), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->successResponse($this->detalle_pedido_service->show($id));
    }
    public function getPedido($id){
        return $this->successResponse($this->detalle_pedido_service->getPedido($id));
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
        return $this->successResponse($this->detalle_pedido_service->delete($id));
    }
}
