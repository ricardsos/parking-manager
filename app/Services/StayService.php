<?php

namespace App\Services;

use App\Models\Stay;
use Carbon\Carbon;

class StayService
{
    /**
     * @param Stay $stay
     * @param float $accumulatedTime
     * @return float
     */
    public function getTotalToPay(Stay $stay, float $accumulatedTime): float
    {
        return $stay->vehicle->vehicleType->vehicleTypeCost->cost_per_measure_unit * $accumulatedTime;
    }

    /**
     * @param Stay $stay
     * @return float
     */
    public function getAccumulatedTimePerStay(Stay $stay): float
    {
        $checkIn = new Carbon($stay->check_in);
        return $checkIn->floatDiffInMinutes(Carbon::now());
    }

    /**
     * @return int
     */
    public function resetAccumulatedTimeByVehicleType(): int
    {
        $officialVehiclesStay = Stay::whereHas('vehicle', function ($query) {
            $query->whereHas('vehicleType', function ($query) {
                $query->whereName('official');
            });
        })->delete();

        $residentVehiclesStay = Stay::whereHas('vehicle', function ($query) {
            $query->whereHas('vehicleType', function ($query) {
                $query->whereName('resident');
            });
        })->update(['accumulated_time' => 0]);

        if(is_null($officialVehiclesStay) && is_null($residentVehiclesStay)) {
            return 0;
        }

        return $officialVehiclesStay + $residentVehiclesStay;
    }

}