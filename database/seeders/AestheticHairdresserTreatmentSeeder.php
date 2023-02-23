<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AestheticHairdresserTreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aesthetic_hairdresser_treatment')->insert([
            'aesthetic_id' => 'B1',
            'hairdresser_id' => null,
            'treatment_id' => '1',
        ]);

        DB::table('aesthetic_hairdresser_treatment')->insert([
            'aesthetic_id' => 'B3',
            'hairdresser_id' => null,
            'treatment_id' => '2',
        ]);

        DB::table('aesthetic_hairdresser_treatment')->insert([
            'aesthetic_id' => null,
            'hairdresser_id' => 'P4',
            'treatment_id' => '3',
        ]);

        DB::table('aesthetic_hairdresser_treatment')->insert([
            'aesthetic_id' => null,
            'hairdresser_id' => 'P2',
            'treatment_id' => '4',
        ]);

        DB::table('aesthetic_hairdresser_treatment')->insert([
            'aesthetic_id' => 'B2',
            'hairdresser_id' => null,
            'treatment_id' => '5',
        ]);

        DB::table('aesthetic_hairdresser_treatment')->insert([
            'aesthetic_id' => null,
            'hairdresser_id' => 'P2',
            'treatment_id' => '6',
        ]);

        DB::table('aesthetic_hairdresser_treatment')->insert([
            'aesthetic_id' => 'B3',
            'hairdresser_id' => null,
            'treatment_id' => '7',
        ]);

        DB::table('aesthetic_hairdresser_treatment')->insert([
            'aesthetic_id' => null,
            'hairdresser_id' => 'P1',
            'treatment_id' => '8',
        ]);

        DB::table('aesthetic_hairdresser_treatment')->insert([
            'aesthetic_id' => 'B2',
            'hairdresser_id' => null,
            'treatment_id' => '9',
        ]);

        DB::table('aesthetic_hairdresser_treatment')->insert([
            'aesthetic_id' => 'B4',
            'hairdresser_id' => null,
            'treatment_id' => '10',
        ]);
    }
}
