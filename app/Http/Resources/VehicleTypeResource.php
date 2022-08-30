<?php

namespace App\Http\Resources;

use App\Models\VehicleTypeCost;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'vehicle_type_cost' => new VehicleTypeCostResource($this->whenLoaded('vehicleTypeCost')),
            'name' => $this->name,
        ];
    }
}
