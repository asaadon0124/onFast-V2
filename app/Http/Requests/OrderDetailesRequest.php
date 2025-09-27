<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderDetailesRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return
        [
            'product_id'            => 'required|exists:products,id',
            'coming_from'           => 'required|exists:status,id',
            'shipping_price'        => 'required|numeric',
            'total_price'           => 'required|numeric',
            'product_status'        => 'required|exists:status,id',
            'notes'                 => 'nullable|string',
        ];
    }
}
