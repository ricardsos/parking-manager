<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleTypeCost extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Get the stays for the vehicle.
     */
    public function vehicleTypes()
    {
        return $this->hasMany(VehicleType::class);
    }
}
