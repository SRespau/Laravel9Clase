<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Study;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Study>
 */
class StudyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Study::class;

    public function definition()
    {
        return [
            "name" => $this->faker->word(),//word()Genera una palabra aleatoria. Tenemos que poner faker para que lo invoque
            "code" => $this->faker->word(), //paragraph() Genera un parrafo aleatorio
            "family" => $this->faker->regexify('[A-Z]{3}[0-9]{3}'), //Genera un string aleatorio con 3 letras y 3 numeros
            "level" => $this->faker->randomElement(['GM', 'GS']),
        ];
    }
}
