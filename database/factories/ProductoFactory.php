<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

use function PHPSTORM_META\map;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->isbn10,
            'nombre' => $this->faker->unique()->lastName,
            'categoria_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]),
            'precio_venta' => $this->faker->numberBetween(1500, 9000),
            'stock' => $this->faker->numberBetween(5, 9000),
            'stock_en_dinero' => $this->faker->numberBetween(6000, 95000),
            'quiebre_stock' => $this->faker->numberBetween(50, 900)
        ];
    }
}
