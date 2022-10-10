<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Services\Compras\CategoriaService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;


class CategoriaController extends Controller
{
    use ApiResponser;
    public $categoriaService;
    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
        $this->middleware('auth:sanctum')->except(['index','show','top','getActivas']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->categoriaService->index());
    }
    public function getActivas()
    {
        return $this->successResponse($this->categoriaService->getActivas());
    }
    public function top()
    {
        return $this->successResponse($this->categoriaService->top());
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
        return $this->successResponse($this->categoriaService->store($request->all()), 201);
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
        return $this->successResponse($this->categoriaService->update($request->all(), $id));
    }
}
