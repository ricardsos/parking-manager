<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $licensePlateNumbers = [
            'OFF2567' => 1,
            'RES2459' => 2,
            'NRE2562' => 3,
            'OFF2892' => 1,
            'RES28561' => 2,
            'NRE28557' => 3
        ];

        foreach ($licensePlateNumbers as $number => $type) {
            DB::table('vehicles')->insert([
                'license_plate_number' => $number,
                'vehicle_type_id' => $type
            ]);
        }
    }
}
