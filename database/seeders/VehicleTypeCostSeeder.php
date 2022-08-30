<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleTypeCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $costsPerMeasureUnit = [
            0,
            0.05,
            0.5
        ];

        foreach ($costsPerMeasureUnit as $cost) {
            DB::table('vehicle_type_costs')->insert([
                'cost_per_measure_unit' => $cost,
                'measure_unit' => 'minute'
            ]);
        }
    }
}
