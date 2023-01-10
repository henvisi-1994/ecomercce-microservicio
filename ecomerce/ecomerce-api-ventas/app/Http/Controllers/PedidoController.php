<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetallePedido;
use App\Models\EnvioPedido;
use App\Models\EstadoPedido;
use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
//use Srmklive\PayPal\Facades\PayPal;
//use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;

class PedidoController extends Controller
{
    private $provider;
    public function __construct()
    {
       // $this->provider =  new PayPalClient;

       // $this->provider = PayPal::setProvider();

       // $this->provider->setApiCredentials(config('paypal'));

     //   $this->provider->setAccessToken($this->provider->getAccessToken());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = DB::table('pedido as ped')
           // ->join('cliente', 'ped.id_cliente', '=', 'cliente.id_cliente')
           // ->join('persona', 'cliente.id_persona', '=', 'persona.id_persona')
            ->orderBy('ped.id_pedido', 'desc')
            ->get();
        return $productos;
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
            'total' => 'required',
            'estado_ped' => 'required|string|max:1',
            'id_cliente' => 'required',
            'id_formapago' => 'required',
        ]);

        Pedido::create([
            'fecha_inicio' => Carbon::now(),
            'fecha_ult_mod' => Carbon::now(),
            'fecha_registro_ped' => Carbon::now(),
            'total' => $validateData['total'],
            'estado_ped' => $validateData['estado_ped'],
            'id_cliente' => $validateData['id_cliente'],
            'id_formapago' => $validateData['id_formapago'],
        ]);
        $data = Pedido::latest('id_pedido')->first();
        EstadoPedido::create([
            'estado_inicial' => 'P',
            'estado_actual' => 'P',
            'estado_final' => 'P',
            'fecha_registro' => Carbon::now(),
            'id_pedido' => $data->id_pedido,
        ]);
        EnvioPedido::create([
            'fecha_inicio_ped' => Carbon::now(),
            'fecha_fin_ped' => Carbon::now(),
            'fecha_registro_env' => Carbon::now(),
            'fecha_fin_ped',
            'ciudad_origen' => 1,
            'ciudad_destino' => 1,
            'id_pedido' => $data->id_pedido,
        ]);
        return $data;
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
        DB::table('pedido')
            ->where('id_pedido', $id)
            ->update(['estado_ped' => 'A']);
    }
    public function Pagar($id)
    {
     /*   DB::table('pedido')
        ->where('id_pedido', $id)
        ->update(['estado_ped' => 'P']);
        $pedido = Pedido::with('cliente', 'forma_pago')
        ->where('id_pedido',$id)
        ->first();
        $detalle = DetallePedido::with('pedido')
        ->where('id_pedido',$id)
        ->get();
        $cliente = Cliente::with('persona','direccion')->where('id_pedido',$id)->first();
        $num_comprobante=$pedido->id_pedido;
        $email=$cliente->email;
        $nomb_usuario=$cliente->persona->nombre_persona.' '.$cliente->persona->apellido_persona;
        $credenciales = [
            'forma_pago'=>$pedido->forma_pago->nomb_formapago,
            'cliente' => $cliente,
            'fecha' => $pedido->fecha_registro_ped,
            'num_comprobante' => $num_comprobante,
            'precio' => $pedido->total,
            'detalle'=>$detalle
        ];
        $nombre_archivo=$num_comprobante.'.pdf';
        $pdf = PDF::loadView('comprobante_pdf', $credenciales);
        $pdf->setPaper('a4', 'portrait');
        /*->save(storage_path('app/public/comprobante/') . $nombre_archivo);*/
       /* Mail::send('comprobante', $credenciales, function ($msj) use ($email, $nomb_usuario,$pdf,$nombre_archivo) {
            $msj->to($email, $nomb_usuario);
            $msj->subject('Comprobante de Pago');
            $msj->attachData($pdf->output(),$nombre_archivo);
        });
*/

    }

    public function enviar($id)
    {
        DB::table('estado_pedido')
            ->where('id_pedido', $id)
            ->update([
                'estado_inicial' => 'P',
                'estado_actual' => 'E',
                'estado_final' => 'P',
            ]);
        DB::table('pedido')
            ->where('id_pedido', $id)
            ->update(['estado_ped' => 'E']);
    }

       /**

     * Charge a payment and store the transaction.

     *

     * @param  \Illuminate\Http\Request  $request

     */

     public function success(Request $request)
     {

         // Once the transaction has been approved, we need to complete it.
          if ($request->input('token') && $request->input('PayerID')) {

             $order_id = $request->input('token');

             $order = $this->provider->authorizePaymentOrder($order_id);
              return view('Nes.planes.pagoexitoso');

         } else {
              return response()->json(['mensaje' => 'Transaction is declined']);

         }

     }
      /**

     * Error Handling.

     */

    public function error()

    {

        return 'User cancelled the payment.';

    }
}
