<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DetallePedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('secretKey')->except(['show']);
    }
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
        //$producto=Producto::where('id_prod',$request->id_prod)->first();
        $precio =0;
        $cantidad = $request->cantidad;
        $producto = Http::withHeaders(['Authorization' =>'vuk$8L9R7C5&'])
            ->get('http://localhost:8002/api/productos/' .$request->id_prod)->json();
       if ( $producto['aplicaiva_prod']==1) {
            $precio = $this->calcularIVA($producto['precio_prod'])* $cantidad ;
        } else {
           $precio = $producto['precio_prod']* $cantidad ;
        }

        DetallePedido::create([
            'id_prod' => $request->id_prod,
            'id_pedido' => $request->id_pedido,
            'cantidad' => $cantidad,
            'total_detalle'=>$precio
        ]);
    }
    private function calcularIVA($precio)
    {
       $iva = $precio *0.12;
       return $precio+$iva;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = DB::table('detalle_pedido as dp')
        ->join('pedido', 'dp.id_pedido', '=', 'pedido.id_pedido')
        ->where('pedido.id_cliente',$id)
        ->where('pedido.estado_ped','I')
        ->get();
        return $cart;
    }
    public function getPedido($id){
        $detalle  = DetallePedido::where('id_pedido',$id)->get();
        return $detalle;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('detalle_pedido')
        ->where('id_detalle_ped', $id)
        ->delete();
    }
}
