<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index','show','top','getActivas']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = DB::table('categoria as c')
            ->orderBy('c.id_cat', 'desc')
            ->get();
        return $categorias;
    }
    public function getActivas()
    {
        $categorias = DB::table('categoria as c')
        ->where('estado_cat','A')
            ->orderBy('c.id_cat', 'desc')
            ->get();
        return $categorias;
    }
    public function top()
    {
        $categorias = DB::table('categoria as c')
        ->where('estado_cat','A')
            ->orderBy('c.id_cat', 'desc')
            ->get()->take(10);
        return $categorias;
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
            'nomb_cat' => 'required|string',
            'estado_cat' => 'required|string',
        ]);
        if ($v) {
            $categoria = new Categoria();
            $categoria->create($request->all());
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
        $nomb_cat = $request->input('nomb_cat');
        $estado_cat = $request->input('estado_cat');
        $observ_cat = $request->input('observ_cat');
        DB::table('categoria')
            ->where('id_cat', $id)
            ->update([
                'nomb_cat' => $nomb_cat,
                'estado_cat' => $estado_cat,
                'observ_cat' => $observ_cat,
            ]);
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
        $estado_cat='I';
        DB::table('categoria')
            ->where('id_cat', $id)
            ->update(['estado_cat' => $estado_cat]
          );
        return;
    }
}
