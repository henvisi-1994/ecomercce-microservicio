<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Services\Compras\CargoService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;


class CargoController extends Controller
{
    use ApiResponser;
    public $cargoService;
    public function __construct(CargoService $cargoService)
    {
        $this->cargoService = $cargoService;
        $this->middleware('auth:sanctum')->except(['index','show',]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->cargoService->index());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->cargoService->store($request->all()), 200);
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
        return $this->successResponse($this->cargoService->update($request->all(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->successResponse($this->cargoService->delete($id));
    }

}
