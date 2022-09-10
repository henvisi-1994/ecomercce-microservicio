<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eloro = new Provincia();
        $eloro->nombre_provincia = 'El Oro';
        $eloro->estado_prov = '1';
        $eloro->id_pais=1;
        $eloro->save();
    }
}
