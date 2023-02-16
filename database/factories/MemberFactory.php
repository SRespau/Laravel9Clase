<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Member;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Member::class;

    public function definition()
    {
        return [
            "nombre" => $this->faker->firstName(),
            "apellidos" => $this->faker->lastName() . " " . $this->faker->lastName(),
            "direccion" => $this->faker->address(),
            "telefono"=> $this->faker->unique()->phoneNumber(),
            "email" => $this->faker->unique()->safeEmail(),
        ];
    }
}
