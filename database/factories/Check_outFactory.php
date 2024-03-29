<?php

namespace Database\Factories;

use App\Models\Check_out;
use Illuminate\Database\Eloquent\Factories\Factory;

class Check_outFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Check_out::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "product_id"=>$this->faker->numberBetween(1,150),
            "user_id"=>$this->faker->numberBetween(1,10)
        ];
    }
}

/*
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
*/
