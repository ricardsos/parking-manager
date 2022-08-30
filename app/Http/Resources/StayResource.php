<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'vehicle' => new VehicleResource($this->whenLoaded('vehicle')),
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'total_to_pay' => $this->total_to_pay,
            'accumulated_time' => $this->accumulated_time,
            'measure_unit' => $this->measure_unit,
        ];
    }
}
