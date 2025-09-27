<?php

namespace App\Admin;

use App\Models\Order;
use App\Models\OrderDetailes;

interface OrderDetailesInterface
{
    public function create($data,$orderId,$selectedProduct);
    public function update($data,OrderDetailes $orderDetailes);
    public function show(OrderDetailes $orderDetailes);
    public function delete(OrderDetailes $orderDetailes);


}
