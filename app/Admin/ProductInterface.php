<?php

namespace App\Admin;

use App\Models\Product;

interface ProductInterface
{
    public function index($search = null);
    public function create($data);
    public function update($data,Product $product);
    public function show(Product $product);
    public function delete(Product $product);
}
