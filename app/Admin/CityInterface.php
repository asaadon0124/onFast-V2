<?php

namespace App\Admin;

use App\Models\City;

interface CityInterface
{
    public function index();
    public function create($data);
    public function update($data,City $city);
    public function delete(City $city);
}
