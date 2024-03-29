<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "rut"=> $this->faker->unique()->randomNumber(),
            'name' => $this->faker->firstName,
            "lastname"=> $this->faker->lastName ,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make($this->faker->password),
            "role_id"=>$this->faker->numberBetween(1,6),
        ];
    }
}
