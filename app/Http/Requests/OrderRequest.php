<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return
        [
            'servant_id'            => 'required|exists:servants,id',
            'total_prices'          => 'required|numeric',
            'total_servant_profit'  => 'required|numeric',
            'total_profit'          => 'required|numeric',
            'notes'                 => 'nullable|string',

        ];
    }
}
