<?php

namespace Database\Seeders;

use App\Models\Iva;
use Illuminate\Database\Seeder;

class IvaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(0);
        $this->create(19);
    }

    public function create($porcentaje)
    {
        Iva::create(['porcentaje' => $porcentaje]);
    }
}
