<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return
        [
            'product_status'    => 'required|exists:status,id',
            // 'productDetailesID' => 'required|exists:order_detailes,id',
        ];
    }
}
