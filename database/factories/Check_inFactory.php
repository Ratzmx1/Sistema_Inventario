<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class Chack_inFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "order_number"=>$this->faker->unique()->randomNumber(),
            "provider_id"=>$this->faker->numberBetween(1,40),
            "user_id"=>$this->faker->numberBetween(1,10)
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
