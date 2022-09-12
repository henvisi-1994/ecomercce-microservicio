<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PaisSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(CiudadSeeder::class);
        $this->call(TipoIdentSeeder::class);
        $this->call(FormaPagoeeder::class);
    }
}
