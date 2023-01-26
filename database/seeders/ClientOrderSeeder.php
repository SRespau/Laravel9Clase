<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order; //Importamos ambas clases para relaciones N:M
use App\Models\Client;

class ClientOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()->count(50)->create();

        //Función anónima: Le decimos que para cada cliente creado lance la función. Dicha función mirará en las order de los clientes y haremos un sync(sustituye, borra e introduce los datos que hubiera antes = attach). 
        //Luego creará aleatoriamente 4 pedidos para cada cliente.
        Client::factory()->count(43)->create()->each(function($client){
            $client->orders()->sync(
                Order::all()->random(4)
            );
        });
    }
}
