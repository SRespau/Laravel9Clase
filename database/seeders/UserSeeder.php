<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administrators')->insert([
            'id' => '1',
            'name' => 'gerente',
            'email' => 'gerente@gmail.com',
            'email_verified_at' => null,
            'password' => password_hash("gerente", PASSWORD_DEFAULT),
            'rol' => 'gerente',
            'remember_token' => null,
        ]);

        DB::table('administrators')->insert([
            'id' => '2',
            'name' => 'recepcionista',
            'email' => 'recepcionista@gmail.com',
            'email_verified_at' => null,
            'password' => password_hash("recepcionista", PASSWORD_DEFAULT),
            'rol' => 'recepcionista',
            'remember_token' => null,
        ]);

        User::factory()->count(3)->create();
    }
}
