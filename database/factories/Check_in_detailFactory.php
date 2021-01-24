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
            "order_number"=>Check_in::all()[0]->order_number,
            "quantity"=>$this->faker->randomNumber(),
            "product_id"=>$this->faker->numberBetween(1,150),
            "provider_id"=>Check_in::all()[0]->provider_id
        ];
    }
}

/*
            $table->id();
            $table->integer('order_number');
            $table->integer('quantity');
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('provider_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['order_number',"provider_id","product_id"]);
*/
