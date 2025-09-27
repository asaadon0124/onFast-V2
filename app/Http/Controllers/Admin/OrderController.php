<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admins.Orders.index');
    }

    public function show($id)
    {
    return view('admins.Orders.show',compact('id'));
    }
}
