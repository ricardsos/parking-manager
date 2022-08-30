<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\VehicleTypeCost;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            VehicleTypeCostSeeder::class,
            VehicleTypeSeeder::class,
            VehicleSeeder::class
        ]);
    }
}
