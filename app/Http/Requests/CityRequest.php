<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules($id = null): array
    {
        return
        [
            'name'              => ['required', Rule::unique('cities')->ignore($id)],
            'governorate_id'    => 'required|exists:governorates,id'
        ];
    }
}
