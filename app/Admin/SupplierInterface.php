<?php

namespace App\Admin;

use App\Models\Supplier;

interface SupplierInterface
{
    public function index();
    public function create($data);
    public function update($data,Supplier $supplier);
    public function delete(Supplier $supplier);
}
