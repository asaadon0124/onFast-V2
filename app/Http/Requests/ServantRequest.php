<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ServantRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules($id = null): array
    {
        return
        [
            'name'              => ['required', Rule::unique('servants')->ignore($id)],
            'password'          => 'required|confirmed|min:8',
            'phone'             => ['required','min:11', Rule::unique('servants')->ignore($id)],
            'adress'            => 'nullable|string',
        ];
    }
}
