<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Laravel abrirá primero este Seeder y luego los creados
        //Llamar a los seeders creados: Añadimos esto al database original para no tener que llamarlo en el artisan con --class
        $this->call([
            ProductSeeder::class,            
            ClientSeeder::class, 
            OrderSeeder::class,
            ClientOrderSeeder::class,
            UserSeeder::class,
            StudySeeder::class,          
        ]);
    }
}
