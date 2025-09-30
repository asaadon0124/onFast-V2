<?php

namespace App\Services\Admin;

use App\Admin\ServantInterface;
use App\Models\Admin;
use App\Admin\SupplierInterface;
use App\Models\Governorate;
use App\Models\Servant;

class ServantService implements ServantInterface
{


    public function index($search = null)
    {

        return $data = Servant::where(function ($query) use ($search): void
        {
            $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%');
        })->latest()->paginate(5);
    }




    public function create($data)
    {
        return Servant::create($data); // دلوقتي كل القيم متخزنة وموجودة

    }


    public function find($id)
    {
        return Servant::findOrFail($id);
    }


    public function update($data, Servant $servant): Servant
    {
        $servant->update($data);
        return $servant;
    }


    public function delete(Servant $servant)
    {
        return $servant->delete();
    }



}
