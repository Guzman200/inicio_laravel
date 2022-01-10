<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Sucursal;
use App\Models\TipoPago;
use App\Models\TipoVenta;
use App\Models\User;
use Database\Factories\SucursalFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        Proveedor::factory(5)->create();
        TipoPago::factory(5)->create();
        Sucursal::factory(2)->create();
        Categoria::factory(15)->create();
        Producto::factory(20)->create();


        User::create([
            'nombres'        => 'Pedro', 
            'email'          => 'my.rg.developer@gmail.com', 
            'password'       => Hash::make('12345'),
            'telefono'       => '9622162349',
            'nombre_usuario' => 'pedro',
            'status'         => true,
            'ap_paterno'     => 'test', 
            'ap_materno'     => 'test'
        ]);

        $this->call(IvaSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(TipoVentaSeeder::class);
        
    }
}
