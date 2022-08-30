<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        DB::table('users')->insert([
            'name' => 'User Test',
            'email' => 'user@test.com',
            'email_verified_at' => '2022-08-30 02:42:32',
            'password' => '$2y$10$gd5nu1rKrELjgPiGSBaKwueaS7i4VOxD/GydskGNyP98YstqA.laa',
            'created_at' => '2022-08-30 03:42:32',
        ]);
    }
}
