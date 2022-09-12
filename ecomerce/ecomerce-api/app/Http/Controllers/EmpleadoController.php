<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
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
       $usuarios = DB::table('empleado as e')
       ->join('empresa', 'e.id_empresa', '=', 'empresa.id_empresa')
       ->join('persona', 'e.id_persona', '=', 'persona.id_persona')
       ->join('cargo', 'e.id_cargo', '=', 'cargo.id_cargo')
       ->join('users', 'e.id_usu', '=', 'users.id')
       ->orderBy('e.id_empleado', 'desc')
       ->get();
        return $usuarios;
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
        $validateData = $request->validate([
            'id_empresa'=>'required',
            'id_cargo'=>'required',
            'email' => 'required|string|email|max:255|unique:users',
            'estado_empl'=>'required',
            'id_persona'=>'required'

        ]);
        $persona=Persona::where('id_persona',$request->id_persona)->first();
        $nombre=$persona->nombre_persona[0];
        $apellido=$persona->apellido_persona;
        $dni=$persona->dni;
        $username= $nombre.'_'.$apellido;
        User::create([
            'name' =>$username,
            'email' => $validateData['email'],
            'password' => Hash::make($dni),
        ]);
        $usuario = User::latest('id')->first();
        Empleado::create([
            'id_empresa' =>$validateData['id_empresa'],
            'id_cargo' => $validateData['id_cargo'],
            'id_usu' =>$usuario ->id,
            'id_persona' => $validateData['id_persona'],
            'estado_empl' =>$validateData['estado_empl'],
        ]);
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
       $id_empresa  =  $request->input('id_empresa');
        $id_usu  =  $request->input('id_usu');
        $id_cargo  =  $request->input('id_cargo');
        $id_persona  =  $request->input('id_persona');
        $estado_empl  =  $request->input('estado_empl');
        $email= $request->input('email');
        $id_usu= $request->input('id_usu');
        DB::table('empleado')
            ->where('id_empleado', $id)
            ->update(['id_empresa'=>$id_empresa,'id_usu'=>$id_usu,'id_cargo'=>$id_cargo,'id_persona'=>$id_persona,'estado_empl'=>$estado_empl]);
            DB::table('users')
            ->where('id', $id_usu)
            ->update(['email'=>$email]);
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
        $estado_empl = 'I';
        DB::table('empleado')
            ->where('id_empleado', $id)
            ->update(['estado_empl' => $estado_empl]);
        return;
    }

}
