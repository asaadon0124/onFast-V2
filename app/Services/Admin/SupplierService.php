<?php

namespace App\Services\Admin;

use App\Models\Admin;
use App\Admin\SupplierInterface;
use App\Models\Governorate;
use App\Models\Supplier;

class SupplierService implements SupplierInterface
{


    public function index($search = null)
    {

        return $data = Supplier::where(function ($query) use ($search): void
        {
            $query->where('name', 'like', '%' . $search . '%');

        })->latest()->paginate(5);
    }




    public function create($data)
    {
        //  $data = $request->validated();
        $data['created_by'] = auth('admin')->id();
        $data['updated_by'] = auth('admin')->id();

        return Supplier::create($data); // دلوقتي كل القيم متخزنة وموجودة

    }



     public function find($id)
    {
        return Supplier::findOrFail($id);
    }




    public function update($data, Supplier $supplier): Supplier
    {
        $data['updated_by'] = auth('admin')->id();
        $supplier->update($data);
        return $supplier;
    }


    public function delete(Supplier $supplier)
    {
        return $supplier->delete();
    }
}
