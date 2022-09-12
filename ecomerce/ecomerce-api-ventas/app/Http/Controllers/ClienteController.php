<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Direcion;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = DB::table('cliente as c')
            ->join('empresa', 'c.id_empresa', '=', 'empresa.id_empresa')
            ->join('persona', 'c.id_persona', '=', 'persona.id_persona')
            ->orderBy('c.id_cliente', 'desc')
            ->get();
        return $clientes;
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
            'estado_cli' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ]);
        if ($v) {
            $persona = Persona::where(
                'id_persona',
                $request->id_persona
            )->first();
            $direccion = new Direcion();
            $direccion->direcion = $request->input('direcion');
            $direccion->calle = $request->input('calle');
            $direccion->numero = $request->input('numero');
            $direccion->piso = $request->input('piso');
            $direccion->telefono = $request->input('telefono');
            $direccion->movil = $request->input('movil');
            $direccion->estado_direccion = 'A';
            $direccion->id_ciudad	 = $request->input('id_ciudad');
            $direccion->save();
            $direccion_last = Direcion::latest('id_direccion')->first();
            $nombre = $persona->nombre_persona;
            $apellido = $persona->apellido_persona;
            $dni = $persona->dni;
            $username = $nombre . ' ' . $apellido;
            User::create([
                'name' => $username,
                'email' => $request->email,
                'password' => Hash::make($dni),
            ]);
            $usuario = User::latest('id')->first();
            $clientes = new Cliente();
            $clientes->id_empresa = $request->input('id_empresa');
            $clientes->id_direccion =$direccion_last->id_direccion;
            $clientes->id_persona = $request->input('id_persona');
            $clientes->tipo_cli = $request->input('tipo_cli');
            $clientes->estado_cli = $request->input('estado_cli');
            $clientes->fecha_inicio = $request->input('fecha_inicio');
            $clientes->fecha_fin = $request->input('fecha_fin');
            $clientes->id_usu = $usuario ->id;
            $clientes->save();
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
        $v = $this->validate(request(), [
            'observ_cli' => 'required',
            'estado_cli' => 'required',
            'fecha_fin' => 'required',
            'fecha_fin' => 'required',
        ]);
        if ($v) {
            $id_empresa = $request->input('id_empresa');
            $id_persona = $request->input('id_persona');
            $observ_cli = $request->input('observ_cli');
            $estado_cli = $request->input('estado_cli');
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $id_direccion= $request->input('id_direccion');
            $direcion  =  $request->input('direcion');
            $calle  =  $request->input('calle');
            $numero  =  $request->input('numero');
            $piso  =  $request->input('piso');
            $telefono  =  $request->input('telefono');
            $movil  =  $request->input('movil');
            $id_ciudad	  =  $request->input('id_ciudad	');
            $estado_direccion  =  $request->input('estado_direccion');
            $email= $request->input('email');
            $id_usu= $request->input('id_usu');
            DB::table('direccion')
            ->where('id_direccion',  $id_direccion)
            ->update(['direcion'=>$direcion,'calle'=>$calle,'numero'=>$numero,'piso'=>$piso,'telefono'=>$telefono,'movil'=>$movil,'id_ciudad'=>$id_ciudad,'estado_direccion'=>$estado_direccion]);
            DB::table('cliente')
                ->where('id_cliente', $id)
                ->update([
                    'observ_cli' => $observ_cli,
                    'estado_cli' => $estado_cli,
                    'fecha_inicio' => $fecha_inicio,
                    'fecha_fin' => $fecha_fin,
                    'id_empresa' => $id_empresa,
                    'id_persona' => $id_persona,
                ]);
                DB::table('users')
                ->where('id', $id_usu)
                ->update(['email'=>$email]);
            return;
        } else {
            return back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estado_cli = 'I';
        DB::table('cliente')
            ->where('id_cliente', $id)
            ->update(['estado_cli' => $estado_cli]);
        return;
    }
}
