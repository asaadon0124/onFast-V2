<?php

namespace App\Admin;

use App\Models\Servant;

interface ServantInterface
{
    public function index();
    public function create($data);
    public function update($data,Servant $servant);
    public function delete(Servant $servant);
}
