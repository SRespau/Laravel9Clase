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
            "code" => $this->faker->paragraph(), //paragraph() Genera un parrafo aleatorio
            "precio" => $this->faker->randomFloat(2,3,40) //randomFloat(). Numero aleatorio float de 2 decimales entre 3 y 40
        ];
    }
}
