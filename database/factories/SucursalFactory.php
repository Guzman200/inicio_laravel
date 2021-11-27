<?php

namespace Database\Factories;

use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Factories\Factory;

class SucursalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sucursal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo'    => $this->faker->unique()->postcode,
            'nombre'    => $this->faker->unique()->company,
            'direccion' => $this->faker->address,
            'telefono'  => $this->faker->unique()->phoneNumber,
            'email'    => $this->faker->unique()->safeEmail
        ];
    }
}
