<?php

namespace App\Http\Requests;

use App\Abstracts\Http\FormRequest;

class GenerateResidentPaymentReportStayRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'file_name' => 'required|string|min:1|max:255',
        ];
    }
}
