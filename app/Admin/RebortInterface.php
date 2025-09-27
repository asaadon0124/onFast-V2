<?php

namespace App\Admin;

interface RebortInterface
{
    public function getSuppliers();
    public function getNewProducts($search = null, $filters = []);
    public function getAllOrderDetailes($status = null);
    public function filterNewProducts($data);
    public function filterAllOrderDetailes($data);

}
