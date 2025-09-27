<?php

namespace App\Admin;

interface DashboardInterface
{
    public function getNewProducts($search = null);
    public function getOrderDetailes($search = null);
    public function getActiveOrdersCount();
}
