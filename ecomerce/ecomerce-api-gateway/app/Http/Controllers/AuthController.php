<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;


class AuthController extends Controller
{
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['register', 'login']);
    }
    public function register(Request $request)
    {
        $persona = Http::withHeaders(['Authorization' => config('services.ventas.secret')])
            ->get('http://localhost:8001/api/persona/'.$request->id_persona);
        $persona = json_decode($persona->body());
        $nombre = $persona->nombre_persona;
        $apellido = $persona->apellido_persona;
        $username = $nombre . ' ' . $apellido;
        $user = new User();
        $user->username = $username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->estado_user = 'A';
        $user->save();
        $direccion = Http::withHeaders(['Authorization' => config('services.ventas.secret')])
            ->post('http://localhost:8001/api/direccion', [
                'direcion' => $request->direcion,
                'calle' => $request->calle,
                'numero' => $request->numero,
                'piso' => $request->piso,
                'telefono' => $request->telefono,
                'movil' => $request->movil,
                'estado_direccion' => 'A',
                'id_ciudad' => $request->id_ciudad,
            ]);
        $direccion = json_decode($direccion->body());
        Http::withHeaders(['Authorization' => config('services.ventas.secret')])
            ->post('http://localhost:8001/api/cliente', [
                'id_direccion' => $direccion->id_direccion,
                'id_persona' => $persona->id_persona,
                'tipo_cli' => $request->tipo_cli,
                'id_usu' => $user->id,
                'estado_cli' => 'A',
            ]);
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
        $user = User::with('rol')->where('email', $request['email'])->first();
        $cliente = Http::withHeaders(['Authorization' => config('services.ventas.secret')])
            ->get('http://localhost:8001/api/cliente/' . $user->id)->json();
        $empleado = Http::withHeaders(['Authorization' => config('services.compras.secret')])
            ->get('http://localhost:8002/api/empleado/' . $user->id)->json();
        $isCliente = false;
        $isEmpleado = false;
        $id_cliente = 0;
        $id_empleado = 0;
        if ($cliente != null) {
            $isCliente = true;
            $id_cliente = $cliente['id_cliente'];
        }
        if ($empleado != null) {
            $isEmpleado = true;
            $id_empleado = $empleado['id_empleado'];
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'User' => $user,
            'is_cliente' => $isCliente,
            'id_cliente' =>  $id_cliente,
            'is_empleado' => $isEmpleado,
            'id_empleado' =>  $id_empleado,
        ]);
    }
}
