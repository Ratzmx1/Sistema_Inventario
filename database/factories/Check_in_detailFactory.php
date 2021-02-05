<?php

namespace Database\Factories;

use App\Models\Check_in;
use App\Models\Check_in_detail;
use Illuminate\Database\Eloquent\Factories\Factory;

class Check_in_detailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Check_in_detail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "check_in_id"=>$this->faker->numberBetween(1,5),
            "product_id"=>$this->faker->numberBetween(1,150),
            "quantity"=>$this->faker->randomNumber()
        ];
    }
}
