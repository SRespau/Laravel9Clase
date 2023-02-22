<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Treatment;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('treatments')->insert([
            'id' => '1',
            'nombre' => 'Masaje Tailandés',
            'tipo' => 'masaje',
            'precio' => '50',
        ]);

        DB::table('treatments')->insert([
            'id' => '2',
            'nombre' => 'Depliacion laser completa',
            'tipo' => 'depilacion',
            'precio' => '90',
        ]);
       
        DB::table('treatments')->insert([
            'id' => '3',
            'nombre' => 'Corte degradado con lavado',
            'tipo' => 'capilares',
            'precio' => '10',
        ]);

        DB::table('treatments')->insert([
            'id' => '4',
            'nombre' => 'Teñimiento de pelo a cualquier color',
            'tipo' => 'capilares',
            'precio' => '40',
        ]);

        DB::table('treatments')->insert([
            'id' => '5',
            'nombre' => 'Mesoterapia',
            'tipo' => 'capilares',
            'precio' => '60',
        ]);

        DB::table('treatments')->insert([
            'id' => '6',
            'nombre' => 'Fotodepilacion',
            'tipo' => 'capilares',
            'precio' => '50',
        ]);

        DB::table('treatments')->insert([
            'id' => '7',
            'nombre' => 'Uñas permanentes',
            'tipo' => 'estetica',
            'precio' => '27',
        ]);

        DB::table('treatments')->insert([
            'id' => '8',
            'nombre' => 'Lavado y peinado',
            'tipo' => 'capilares',
            'precio' => '25',
        ]);

        DB::table('treatments')->insert([
            'id' => '9',
            'nombre' => 'Masaje descontracturante',
            'tipo' => 'masaje',
            'precio' => '70',
        ]);

        DB::table('treatments')->insert([
            'id' => '10',
            'nombre' => 'Presoterapia',
            'tipo' => 'estetica',
            'precio' => '80',
        ]);
    }
}
