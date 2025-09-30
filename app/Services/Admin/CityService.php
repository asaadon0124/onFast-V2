<?php

namespace App\Services\Admin;

use App\Models\Admin;
use App\Models\Governorate;
use App\Admin\CityInterface;
use App\Models\City;

class CityService implements CityInterface
{


    public function index($search = null)
    {
        return $data = City::where(function ($query) use ($search): void
        {
            $query->where('name', 'like', '%' . $search . '%');

        })->latest()->paginate(5);
    }



    public function create($data)
    {
        return City::create($data); // دلوقتي كل القيم متخزنة وموجودة
    }


    public function find($id)
    {
        return City::findOrFail($id);
    }


    public function update($data, City $city)
    {
       return  $city->update($data);
    }


    public function delete(City $city)
    {
        return $city->delete();
    }
}
