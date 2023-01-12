<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product; //Importamos el modelo

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {/* USANDO SEEDERS SOLAMENTE, SIN FACTORY

        //DB::table("products")->truncate(); //Trunca la tabla = vacia la tabla

        DB::table('products')->insert([
            'nombre' => "Alicates", //Str::random(10) en vez del nombre. Generamos una cadena aleatoria
            'descripcion' => "Super alicates",//Str::random(10).'@gmail.com'Generamos una cadena aleatoria y le añadimos @gmail.com 
            'precio' => 3.20,//Hash::make('password') Generar una contraseña en hash
        ]);

        DB::table('products')->insert([
            'nombre' => "Martillo", 
            'descripcion' => "Martillo de Thor",
            'precio' => 1.99,
        ]);
        */

        //USANDO FACTORY (Creamos 23 datos que usen lo que hemos puesto en ProductFactory)
        Product::factory()->count(23)->create();

        /*  EJEMPLO DOCUMENTACION. Añade 50 usuarios a un solo post. Digamos que el post es la clave foranea para los 50 usuarios (en un post han hablado 50 personas)  
        User::factory()
            ->count(50)
            ->hasPosts(1)
            ->create();
            */
    }
}
