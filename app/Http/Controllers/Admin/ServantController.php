<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServantController extends Controller
{
    public function index()
    {
        return view('admins.Servants.index');
    }
}
