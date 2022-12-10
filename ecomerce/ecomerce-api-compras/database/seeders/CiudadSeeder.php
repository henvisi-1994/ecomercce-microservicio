<?php

namespace Database\Seeders;

use App\Models\Ciudad;
use Illuminate\Database\Seeder;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machala = new Ciudad();
        $machala->nombre_ciudad = 'Machala';
        $machala->estado_ciudad = '1';
        $machala->id_provincia = 1;
        $machala->save();
        $arenillas = new Ciudad();
        $arenillas->nombre_ciudad = 'Arenillas';
        $arenillas->estado_ciudad = '1';
        $arenillas->id_provincia = 1;
        $arenillas->save();
        $atahualpa = new Ciudad();
        $atahualpa->nombre_ciudad = 'Atahualpa';
        $atahualpa->estado_ciudad = '1';
        $atahualpa->id_provincia = 1;
        $atahualpa->save();
        $balsas = new Ciudad();
        $balsas->nombre_ciudad = 'Balsas';
        $balsas->estado_ciudad = '1';
        $balsas->id_provincia = 1;
        $balsas->save();
        $chilla = new Ciudad();
        $chilla->nombre_ciudad = 'Chilla';
        $chilla->estado_ciudad = '1';
        $chilla->id_provincia = 1;
        $chilla->save();
        $elguabo = new Ciudad();
        $elguabo->nombre_ciudad = 'El Guabo';
        $elguabo->estado_ciudad = '1';
        $elguabo->id_provincia = 1;
        $elguabo->save();
        $huaquillas = new Ciudad();
        $huaquillas->nombre_ciudad = 'Huaquillas';
        $huaquillas->estado_ciudad = '1';
        $huaquillas->id_provincia = 1;
        $huaquillas->save();
        $marcabeli = new Ciudad();
        $marcabeli->nombre_ciudad = 'Marcabeli';
        $marcabeli->estado_ciudad = '1';
        $marcabeli->id_provincia = 1;
        $marcabeli->save();
        $pasaje = new Ciudad();
        $pasaje->nombre_ciudad = 'Pasaje';
        $pasaje->estado_ciudad = '1';
        $pasaje->id_provincia = 1;
        $pasaje->save();
        $piñas = new Ciudad();
        $piñas->nombre_ciudad = 'Piñas';
        $piñas->estado_ciudad = '1';
        $piñas->id_provincia = 1;
        $piñas->save();
        $portovelo = new Ciudad();
        $portovelo->nombre_ciudad = 'Portovelo';
        $portovelo->estado_ciudad = '1';
        $portovelo->id_provincia = 1;
        $portovelo->save();
        $santarosa = new Ciudad();
        $santarosa->nombre_ciudad = 'Santa Rosa';
        $santarosa->estado_ciudad = '1';
        $santarosa->id_provincia = 1;
        $santarosa->save();
        $zaruma = new Ciudad();
        $zaruma->nombre_ciudad = 'Zaruma';
        $zaruma->estado_ciudad = '1';
        $zaruma->id_provincia = 1;
        $zaruma->save();
        $laslajas = new Ciudad();
        $laslajas->nombre_ciudad = 'Las Lajas';
        $laslajas->estado_ciudad = '1';
        $laslajas->id_provincia = 1;
        $laslajas->save();

    }
}
