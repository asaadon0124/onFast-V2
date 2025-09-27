<?php

namespace App\Admin;

use App\Models\Governorate;

interface GovernorateInterface
{
    public function index($search = null);
    public function create($data);
    public function update($data, Governorate $governorate);
    public function delete($id);
}
