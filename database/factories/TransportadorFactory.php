<?php

namespace Database\Factories;

use App\Models\Transportador;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransportadorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transportador::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres'   => $this->faker->name,
            'apellidos' => $this->faker->lastName,
            'telefono'  => $this->faker->unique()->phoneNumber,
            'correo'    => $this->faker->unique()->safeEmail
        ];
    }
}
