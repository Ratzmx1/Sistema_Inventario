<?php

namespace Database\Factories;

use App\Models\Check_in;
use Illuminate\Database\Eloquent\Factories\Factory;

class Check_inFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Check_in::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "order_number"=>$this->faker->unique()->numberBetween(1,4000),
            "provider_id"=>$this->faker->unique()->numberBetween(1,30),
            "user_id"=>1
        ];
    }
}

/*
            $table->id();
            $table->integer('order_number');
            $table->foreignId('provider_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['order_number','provider_id']);
 */
