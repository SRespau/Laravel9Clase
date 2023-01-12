<?php

namespace Database\Factories;

use App\Models\Order; //Hay que añadirlo
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Order::class; //Hay que crear si o si la referencia con el modelo

    public function definition()
    {
        return [
            "cliente" => $this->faker->word(),//word()Genera una palabra aleatoria. Tenemos que poner faker para que lo invoque
            "fecha" => $this->faker->dateTime(), //randomFloat(). Numero aleatorio float de 2 decimales entre 3 y 40
            "descripcion" => $this->faker->paragraph(), //paragraph() Genera un parrafo aleatorio
        ];
    }
}
