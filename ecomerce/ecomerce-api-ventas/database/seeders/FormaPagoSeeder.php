<?php

namespace Database\Seeders;

use App\Models\FormaPago;
use Illuminate\Database\Seeder;

class FormaPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paypal = new FormaPago();
        $paypal->nomb_formapago = 'Paypal';
        $paypal->observ_formapago = 'Pago con Paypal';
        $paypal->estado_formapago = '1';
        $paypal->save();
    }
}
