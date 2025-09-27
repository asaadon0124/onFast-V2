<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class GovernorateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules($id = null): array
    {
        // dd($id);
       return
       [
        'name' =>
        [
            'required',
            Rule::unique('governorates')->ignore($id),
        ],
    ];
    }


    public function messages(): array
    {
        return
        [
            'name.required' => 'اسم المحافظة مطلوب',
            'name.unique'   => 'اسم المحافظة مسجل مسبقاً',
        ];
    }
}
