<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Direccion;
use App\Models\Direcion;
use App\Models\Persona;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes =Cliente::with('persona','direccion')
            ->orderBy('id_cliente', 'desc')
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
            $cliente = new Cliente();
            $cliente->id_direccion = $request->input('id_direccion');
            $cliente->id_persona = $request->input('id_persona');
            $cliente->tipo_cli = $request->input('tipo_cli');
            $cliente->estado_cli = 'A';
            $cliente->fecha_inicio = Carbon::now();
            $cliente->fecha_fin = Carbon::now();
            $cliente ->id_usu = $request->input('id_usu');
            $cliente->save();
            return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::with('persona','direccion')
        ->where('id_cliente', $id)
        ->orwhere('id_usu', $id)
        ->first();
        return $cliente;
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
            $cliente = Cliente::where('id_cliente', $id)->first();
            $direccion = Direccion::where('id_direccion', $cliente->id_direccion)->first();
            $cliente->id_empresa = $request->input('id_empresa');
            $cliente->id_persona = $request->input('id_persona');
            $cliente->observ_cli = $request->input('observ_cli');
            $cliente->estado_cli = $request->input('estado_cli');
            $cliente->fecha_inicio = $request->input('fecha_inicio');
            $cliente->fecha_fin = $request->input('fecha_fin');
            $cliente->save();
            $direccion->direccion  =  $request->input('direcion');
            $direccion->calle  =  $request->input('calle');
            $direccion->numero  =  $request->input('numero');
            $direccion->piso  =  $request->input('piso');
            $direccion->telefono  =  $request->input('telefono');
            $direccion->movil  =  $request->input('movil');
            $direccion->id_ciudad	  =  $request->input('id_ciudad	');
            $direccion->estado_direccion  =  $request->input('estado_direccion');
            $direccion->save();
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
        Cliente::where('id_cliente', $id)
            ->update(['estado_cli' => $estado_cli]);
        return;
    }
}
