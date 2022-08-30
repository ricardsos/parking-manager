<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $string, mixed $licensePlateNumber)
 * @method static whereHas(string $string, \Closure $param)
 */
class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'license_plate_number',
        'vehicle_type_id'
    ];

    /**
     * Get the stays for the vehicle.
     */
    public function stays(): HasMany
    {
        return $this->hasMany(Stay::class);
    }

    /**
     * Get the vehicle type that owns the vehicle.
     */
    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }
}
