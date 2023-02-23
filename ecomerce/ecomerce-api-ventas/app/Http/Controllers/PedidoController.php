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
use GuzzleHttp\Client;
use Barryvdh\DomPDF\Facade as PDF;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class PedidoController extends Controller
{
    private $paypal;
    private $autenticacion_sanbox;
    public function __construct()
    {
       $this->paypal=config('paypal');
       $this->autenticacion_sanbox= 'Bearer '.$this->tokenPalypal();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::with('cliente','detalle')
            ->orderBy('id_pedido', 'desc')
            ->get();
        return $pedidos;
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


        Pedido::create([
            'fecha_inicio' => Carbon::now(),
            'fecha_ult_mod' => Carbon::now(),
            'fecha_registro_ped' => Carbon::now(),
            'total' => $request->total ,
            'estado_ped' => $request->estado_ped,
            'id_cliente' => $request->id_cliente,
            'id_formapago' => $request->id_formapago,
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
        $detalle = DetallePedido::with('pedido')
        ->where('id_pedido',$id)
        ->get();
        $detalle= collect($detalle);
         $detalle->map(function ($pedido) {
           $pedido->producto = $this->producto_pedido($pedido->id_prod);
        });
        $dateTime = new \DateTime();
        $detalle_paypal = $this->get_detalle_paypal($detalle,$dateTime->getTimestamp());
        $aplication_context [] = [
            'brand_name' => 'E-comerce-Project',
            'locale' => 'es-PE',
            'shipping_preference' => 'SET_PROVIDED_ADDRESS',
            'user_action' => 'PAY_NOW',
            'payment_method' => [
                'payer_selected' => 'PAYPAL',
                'payee_preferred' => 'IMMEDIATE_PAYMENT_REQUIRED'
            ],
            'return_url' => 'http://localhost:8000/pedidos',
            'cancel_url' => 'http://localhost:8000/pedidos'
        ];
        $response = Http::withHeaders([
            'Authorization' => $this->autenticacion_sanbox
        ])->post('https://api-m.sandbox.paypal.com/v2/checkout/orders', [
            'intent'=>'CAPTURE','purchase_units' => $detalle_paypal ,'aplication_context' => $aplication_context
        ]);
        return response()->json(['mensaje' => 'Pedido Procesado Correctamente','id' => $response['id'],'status' => $response['status'],'link' => $response['links'][1]['href']]);

     /*   DB::table('pedido')
        ->where('id_pedido', $id)
        ->update(['estado_ped' => 'P']);
        $pedido = Pedido::with('cliente', 'forma_pago')
        ->where('id_pedido',$id)
        ->first();

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
    private function get_detalle_paypal($detalle,$dateTime){
        $items = [];
        foreach ($detalle as $item) {
            $items[] = [
                'reference_id' => $dateTime.$item->id_prod,
                'amount' => [
                    'currency_code' => 'USD',
                    'value' => $item->producto->precio_prod
                ],
                'description' => $item->producto->present_prod
            ];
        }
        return  $items;
    }
    private function producto_pedido($id){
        $client = new Client();
        $res = $client->request('GET', 'http://localhost:8002/api/productos/'.$id);
        $producto =  json_decode($res->getBody());
        return $producto;
    }
    private function tokenPalypal()
    {
        $client = new Client();
        $response = $client->post('https://api-m.sandbox.paypal.com/v1/oauth2/token', [
            'auth' => [
                env('PAYPAL_SANDBOX_CLIENT_ID'),
                env('PAYPAL_SANDBOX_CLIENT_SECRET')
            ],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'grant_type' => 'client_credentials'
            ]
        ]);
        $body = json_decode((string) $response->getBody(), true);
        return $body['access_token'];
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

        /* // Once the transaction has been approved, we need to complete it.
          if ($request->input('token') && $request->input('PayerID')) {

             $order_id = $request->input('token');

             $order = $this->provider->authorizePaymentOrder($order_id);
              return view('Nes.planes.pagoexitoso');

         } else {
              return response()->json(['mensaje' => 'Transaction is declined']);

         }*/

     }
      /**

     * Error Handling.

     */

    public function error()

    {

        return 'User cancelled the payment.';

    }
}
