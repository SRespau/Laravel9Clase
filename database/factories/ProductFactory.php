<?php

namespace Database\Factories;

use App\Models\Product; //Hay que importarlo para que no de error
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class; //Asocio el modelo al que va relacionado. Necesario para que funcione aunque este vacio

    public function definition()
    {
        return [//Aqui asocio los datos
            "nombre" => $this->faker->word(),//word()Genera una palabra aleatoria. Tenemos que poner faker para que lo invoque
            "descripcion" => $this->faker->paragraph(), //paragraph() Genera un parrafo aleatorio
            "precio" => $this->faker->randomFloat(2,2,10), //randomFloat(). Numero aleatorio float de 2 decimales entre 3 y 40
            
        ];
    }
}
