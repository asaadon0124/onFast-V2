<?php

namespace App\Services\Admin;

use App\Admin\ProductInterface;
use App\Models\Product;

class ProductService implements ProductInterface
{


    public function index($search = null)
    {

        return $data = Product::where('status_id', 1)->where(function ($query) use ($search): void
        {
            $query->where('resever_name', 'like', '%' . $search . '%')
            ->orWhere('resver_phone', 'like', '%' . $search . '%')
            ->orWhere('tracking_number', 'like', '%' . $search . '%')
            ->orWhere('resver_address', 'like', '%' . $search . '%')
            ->orWhereHas('supplier', function ($q) use ($search): void
            {
                    $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            });

        })->with(['supplier', 'governorate', 'city', 'statusRelation', 'adminCreate'])->latest()->paginate(2);
    }




    public function create($data)
    {
        return Product::create($data); // دلوقتي كل القيم متخزنة وموجودة
    }



    public function find($id)
    {
        return Product::findOrFail($id);
    }




    public function update($data, Product $product): Product
    {
        $product->update($data);
        return $product;
    }


    public function show(Product $product): Product
    {
        return $product;
    }


    public function delete(Product $product)
    {
        return $product->delete();
    }
}
