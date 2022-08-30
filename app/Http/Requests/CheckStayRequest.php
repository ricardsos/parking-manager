<?php

namespace App\Http\Requests;


use App\Abstracts\Http\FormRequest;

class CheckStayRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'license_plate_number' => 'required|exists:vehicles,license_plate_number',
        ];
    }
}
