<?php

namespace App\Admin;

use App\Models\OrderDetailes;

interface ProductManagementStatusInterface
{
    public function changeStatus($data,OrderDetailes $orderDetailes);
}
