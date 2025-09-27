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


    public function print()
    {
        return view('admins.Reborts.print');
    }   
}
