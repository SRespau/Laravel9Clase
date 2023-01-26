<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client; //Hay que importarlo para que no de error


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Client::class;

    public function definition()
    {
        
        return [
            "dni" => $this->faker->unique()->dni(),
            "name" => $this->faker->firstName(),
            "surname" => $this->faker->lastName() . " " . $this->faker->lastName(),
            "phoneNumber"=> $this->faker->unique()->phoneNumber(),
            "email" => $this->faker->unique()->safeEmail()
        ];
    }
}
