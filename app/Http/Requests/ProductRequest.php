<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules($id = null): array
    {
        return
        [
            // 'tracking_number'       => 'required|unique:products,tracking_number,'.$id,
            'resever_name'          => 'required',
            'resver_phone'          => 'required|min:11',
            'resver_address'        => 'required',
            'supplier_id'           => 'required|exists:suppliers,id',
            'governorate_id'        => 'required|exists:governorates,id',
            'city_id'               => 'required|exists:cities,id',
           'product_price'          => 'required|numeric',
            'shipping_price'        => 'required|numeric',
            'total_price'           => 'required|numeric',
           'rescive_date'           => 'required|date|after_or_equal:today',
            // 'status_id'             => 'required|exists:status,id',
            'notes'                 => 'nullable|string'
        ];
    }


    // public function messages(): array
    // {

    // }
}
