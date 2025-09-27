<?php

namespace App\Admin;

use App\Models\Order;

interface OrderInterface
{
    public function index($search = null);
    public function create($data);
    public function update($data,Order $order);
    public function show(Order $order);
    // public function abrove(Order $order);
    public function delete(Order $order);
}
