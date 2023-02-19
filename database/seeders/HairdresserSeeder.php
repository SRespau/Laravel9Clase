<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HairdresserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hairdressers')->insert([
            'id' => 'P1',
            'nif' => 'B50298334',
            'nombre' => 'Haircademy',
            'razon_social' => 'S.A.',
            'direccion' => 'Plaza SanBenito, 3',
            'email' => 'Haircademy809@gmail.com',
            'telefono' => '976539729',
            'unisex' => true,
            'maximo_personas' => '7'
        ]);

        DB::table('hairdressers')->insert([
            'id' => 'P2',
            'nif' => 'B50834334',
            'nombre' => 'Peluqueria Ana Maria',
            'razon_social' => 'S.L.',
            'direccion' => 'Calle Calatayud, 7',
            'email' => 'Peluqueriadeana@gmail.com',
            'telefono' => '654782838',
            'unisex' => false,
            'maximo_personas' => '3'
        ]);

        DB::table('hairdressers')->insert([
            'id' => 'P3',
            'nif' => 'B50763424',
            'nombre' => 'BluesBarber',
            'razon_social' => 'S.C.',
            'direccion' => 'Calle Fray Julián Garcés, 13',
            'email' => 'BluesBarber13@gmail.com',
            'telefono' => '976239020', 
            'unisex' => true,
            'maximo_personas' => '5'
        ]);

        DB::table('hairdressers')->insert([
            'id' => 'P4',
            'nif' => 'B50155263',
            'nombre' => 'NewStyleHaircut',
            'razon_social' => 'S.A.',
            'direccion' => 'Av Alcalde Francisco Caballero 40',
            'email' => 'informacion@newstylehaircut.es',
            'telefono' => '976539433',
            'unisex' => false,
            'maximo_personas' => '10'
        ]);
        
    }
}
