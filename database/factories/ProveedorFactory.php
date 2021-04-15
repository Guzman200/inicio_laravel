<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proveedor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'proveedor'    => $this->faker->unique()->name,
            'rut'    => $this->faker->unique()->isbn10,
            'giro'    => $this->faker->randomElement(['Software', 'Pesca', 'Construcción', 'Ganadería']),
            'direccion' => $this->faker->address,
            'telefono'  => $this->faker->unique()->phoneNumber,
            'contacto'    => $this->faker->unique()->safeEmail
        ];
    }
}
