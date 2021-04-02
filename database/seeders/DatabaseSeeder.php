<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Material;
use App\Models\Transportador;
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
        // User::factory(10)->create();
        Transportador::factory(20)->create();
        Categoria::factory(20)->create();
        Material::factory(20)->create();
    }
}
