<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'official' => 1,
            'resident' => 2,
            'non-resident' => 3
        ];

        foreach ($names as $name => $id) {
            DB::table('vehicle_types')->insert([
                'name' => $name,
                'vehicle_type_cost_id' => $id
            ]);
        }
    }
}
