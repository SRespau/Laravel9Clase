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
            'nombre' => 'Masaje Tailandes',
            'tipo' => 'masaje',
            'precio' => '49.99',
        ]);

        DB::table('treatments')->insert([
            'id' => '2',
            'nombre' => 'Depliacion laser completa',
            'tipo' => 'depilacion',
            'precio' => '89.99',
        ]);
       
        DB::table('treatments')->insert([
            'id' => '3',
            'nombre' => 'Corte degrado con lavado',
            'tipo' => 'capilares',
            'precio' => '9.99',
        ]);

        DB::table('treatments')->insert([
            'id' => '4',
            'nombre' => 'Teñimiento de pelo a cualquier color',
            'tipo' => 'capilares',
            'precio' => '39.99',
        ]);
    }
}
