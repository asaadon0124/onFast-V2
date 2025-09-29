<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admins.Reborts.index');
    }

    public function index_servants()
    {
        return view('admins.Reborts.index_servants');
    }


    public function print($status_id)
    {
        return view('admins.Reborts.print',compact('status_id'));
    }
}
