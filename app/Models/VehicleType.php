<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleType extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Get the stays for the vehicle.
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    /**
     * Get the vehicle type costo that owns the vehicle type.
     */
    public function vehicleTypeCost(): BelongsTo
    {
        return $this->belongsTo(VehicleTypeCost::class);
    }
}
