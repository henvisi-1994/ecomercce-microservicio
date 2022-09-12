<?php

namespace Database\Seeders;

use App\Models\TipoIdentificacion;
use Illuminate\Database\Seeder;

class TipoIdentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cedula = new TipoIdentificacion();
        $cedula->nombre_tipo_ident = 'Cédula';
        $cedula->estado_tipo_ident = '1';
        $cedula->save();
        $ruc = new TipoIdentificacion();
        $ruc->nombre_tipo_ident = 'RUC';
        $ruc->estado_tipo_ident = '1';
        $ruc->save();
    }
}
