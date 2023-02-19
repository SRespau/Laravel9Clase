<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Aesthetic;

class AestheticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aesthetic_centers')->insert([
            'id' => 'B1',
            'nif' => 'B50023398',
            'nombre' => 'Centro de belleza Santa Ana',
            'razon_social' => 'S.L.',
            'direccion' => 'Plaza España, 3',
            'email' => 'bellezasantaana9@gmail.com',
            'telefono' => '976534339',
            'servicio_fisio' => 'NO',
            'num_salas' => '2'
        ]);

        DB::table('aesthetic_centers')->insert([
            'id' => 'B2',
            'nif' => 'B50004564',
            'nombre' => 'Adara Belleza',
            'razon_social' => 'S.A.',
            'direccion' => 'Calle Fray Angel, 72',
            'email' => 'antencion@adara.com',
            'telefono' => '976031139',
            'servicio_fisio' => 'SI',
            'num_salas' => '10'
        ]);

        DB::table('aesthetic_centers')->insert([
            'id' => 'B3',
            'nif' => 'B50112344',
            'nombre' => 'Hair men salon',
            'razon_social' => 'S.C.',
            'direccion' => 'Calle Fray Julián Garcés, 45',
            'email' => 'hairmensalon45@gmail.com',
            'telefono' => '976230020', 
            'servicio_fisio' => 'NO',
            'num_salas' => '6'
        ]);

        DB::table('aesthetic_centers')->insert([
            'id' => 'B4',
            'nif' => 'B50377263',
            'nombre' => 'Centro de estetica Spectrum',
            'razon_social' => 'S.A.',
            'direccion' => 'Av Alcalde Francisco Caballero 1',
            'email' => 'informacion@spectrum.es',
            'telefono' => '976522433',
            'servicio_fisio' => 'SI',
            'num_salas' => '4'
        ]);
        
    }
}
