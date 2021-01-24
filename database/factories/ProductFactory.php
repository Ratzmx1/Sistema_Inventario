<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**s
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"=>$this->faker->randomNumber(),
            "stock"=>$this->faker->randomNumber(),
            "marca"=>$this->faker->firstName,
            "min_stock"=>$this->faker->randomNumber(),
            "subcategory_id"=>$this->faker->numberBetween(1,40)
        ];
    }
}
