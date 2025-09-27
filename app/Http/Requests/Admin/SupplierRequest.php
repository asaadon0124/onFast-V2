<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class SupplierRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules($id = null): array
    {
        return
        [
            'name'              => ['required', Rule::unique('suppliers')->ignore($id)],
            'governorate_id'    => 'required|exists:governorates,id',
            'city_id'           => 'required|exists:cities,id',
            'phone'             => ['required','min:11', Rule::unique('suppliers')->ignore($id)],
            'adress'            => 'nullable|string',
        ];
    }
}
