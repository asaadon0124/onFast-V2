<?php

namespace App\Admin;

interface RebortServantInterface
{
    public function getServants();
    public function getAllOrderDetailes($status = null);
    public function filterAllOrderDetailes($data);
}
