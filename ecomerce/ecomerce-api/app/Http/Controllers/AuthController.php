<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Direcion;
use App\Models\Empleado;
use App\Models\Persona;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['register','login']);
    }
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $persona = Persona::where(
            'id_persona',
            $request->id_persona
        )->first();
        $nombre = $persona->nombre_persona;
        $apellido = $persona->apellido_persona;
        $username = $nombre . ' ' . $apellido;
        $user = User::create([
            'name' => $username,
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
            'estado_user'=>'A'
        ]);
        $usuario = User::latest('id')->first();
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

        $clientes = new Cliente();
        $clientes->id_empresa = $request->input('id_empresa');
        $clientes->id_direccion =  $direccion_last->id_direccion;
        $clientes->id_persona = $request->input('id_persona');
        $clientes->tipo_cli = $request->input('tipo_cli');
        $clientes->estado_cli = 'A';
        $clientes->fecha_inicio =  Carbon::now();
        $clientes->fecha_fin =  Carbon::now();
        $clientes->id_usu = $usuario ->id;
        $clientes->save();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(
                [
                    'message' => 'Email o contraseña invalido',
                ],
                401
            );
        }
        $user = User::where('email', $request['email'])->first();
        $empleado = Empleado::where('id_usu',$user->id)->get();
        $cliente = Cliente::where('id_usu',$user->id)->get();
      $isEmpleado = false;
        $isCliente=false;
        $id_empleado=0;
        $id_cliente=0;
        if(count($empleado)==1){
            $isEmpleado=true;
            $id_empleado= $empleado[0]->id_empleado;
        }else{
            $isEmpleado= false;
        }
        if(count($cliente)==1){
            $isCliente=true;
            $id_cliente= $cliente[0]->id_cliente;
        }else{
            $isCliente= false;
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'User'=> $user,
            'is_empleado' => $isEmpleado,
            'is_cliente' =>$isCliente,
            'id_empleado' => $id_empleado,
            'id_cliente'=>  $id_cliente
        ]);
    }
}
