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
    }
}
