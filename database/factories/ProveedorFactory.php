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
            'nombre'    => $this->faker->unique()->name,
            'direccion' => $this->faker->address,
            'telefono'  => $this->faker->unique()->phoneNumber,
            'correo'    => $this->faker->unique()->safeEmail
        ];
    }
}
