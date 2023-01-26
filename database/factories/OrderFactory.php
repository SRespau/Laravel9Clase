<?php

namespace Database\Factories;

use App\Models\Order; //Hay que añadirlo
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

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

    //Añadimo esto por haber incluido una clave foranea de clients en un modify
    

    public function definition()
    {
        return [
            "producto" => $this->faker->word(),//word()Genera una palabra aleatoria. Tenemos que poner faker para que lo invoque
            "fecha" => $this->faker->date("Y_m_d"), //randomFloat(). Numero aleatorio float de 2 decimales entre 3 y 40
            "descripcion" => $this->faker->paragraph(), //paragraph() Genera un parrafo aleatorio
            "client_id" => Client::inRandomOrder()->first()->id // Las funciones recorreran las filas de la tabla cliente aleatoriamente y cogera la primera fila. Luego obtendra la id y la pegará en order
            //También se puede poner para relaciones 1:n client_id" => Client::all()->random()->id
        ];
    }
}
