<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Material::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre'       => $this->faker->domainName,
            'categoria_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8]),
            'acabado'      => $this->faker->randomElement(['azul','morado','aluminio','rojo']),
            'cantidad'     => $this->faker->randomDigit
        ];
    }
}
