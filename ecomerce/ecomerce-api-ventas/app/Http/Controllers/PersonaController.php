<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
   /* public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['store']);
    }*/
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
        $v = $this->validate(request(), [

            'nombre_persona' => 'required',
            'apellido_persona' => 'required',
            'dni' => 'required',
            'id_tipo_ident' => 'required'
        ]);
        if ($v) {
            $persona = new Persona();
            $persona->id_tipo_ident = $request->input('id_tipo_ident');
            $persona->nombre_persona = $request->input('nombre_persona');
            $persona->apellido_persona	 = $request->input('apellido_persona');
            $persona->dni = $request->input('dni');
            $persona->save();
            $data = Persona::latest('id_persona')->first();
            return $data;
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
        DB::table('persona')
        ->where('id_persona', $id)
        ->update($request->all());
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
