<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Services\Compras\ProductoService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;


class ProductoController extends Controller
{
    use ApiResponser;
    public $productoService;
    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->productoService->index());
    }
    public function getProductActivos(){
        return $this->successResponse($this->productoService->getProductActivos());
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
        return $this->successResponse($this->productoService->store($request->all()), 201);
    }
    public function getProductoCategoria($id){
        return $this->successResponse($this->productoService->getProductoCategoria($id));
    }

public function getProductoTop(){
    return $this->successResponse($this->productoService->getProductoTop());
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->successResponse($this->productoService->show($id));
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
        return $this->successResponse($this->productoService->update($request->all(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->successResponse($this->productoService->delete($id));
    }
}
