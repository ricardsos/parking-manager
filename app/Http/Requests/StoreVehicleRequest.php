<?php

namespace App\Http\Requests;

use App\Abstracts\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'license_plate_number' => 'required|string|min:2|max:50|unique:vehicles,license_plate_number',
            'vehicle_type_id' => 'required|integer|min:1|exists:vehicle_types,id',
        ];
    }
}
