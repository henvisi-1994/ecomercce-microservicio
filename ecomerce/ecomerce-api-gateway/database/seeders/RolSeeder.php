<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'nombre_rol' => 'admin',
                'descripcion_rol' => 'Administrador',
                'codigo_rol' => 'ADMIN',
            ],
            [
                'nombre_rol' => 'cliente',
                'descripcion_rol' => 'Cliente',
                'codigo_rol' => 'CLI',
            ],
            [
                'nombre_rol' => 'vendedor',
                'descripcion_rol' => 'Vendedor',
                'codigo_rol' => 'VEN',
            ],
        ];

        foreach ($roles as $rol) {
            Roles::create($rol);
        }
    }
}
