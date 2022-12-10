<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Compras\EmpleadoService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class EmpleadoController extends Controller
{
    use ApiResponser;
    public $empleadoService;
    public function __construct(EmpleadoService $empleadoService)
    {
        $this->empleadoService = $empleadoService;
        $this->middleware('auth:sanctum')->except(['index','show',]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->empleadoService->index());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
   $empleado = Http::withHeaders(['Authorization' => config('services.compras.secret')])
    ->post('http://localhost:8002/api/empleado', [
        'id_persona' => $persona->id_persona,
        'id_empresa' => $request->id_empresa,
        'id_usu' => $user->id,
        'id_cargo' => $request->id_cargo,
        'estado_empl' => 'A',
    ]);
    return $empleado;
    return response()->json([
        'mensaje' => 'Empleado registrado con exito'
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
        return $this->successResponse($this->empleadoService->show($id), 200);
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
        return $this->successResponse($this->empleadoService->update($request->all(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->successResponse($this->empleadoService->delete($id));
    }

}
