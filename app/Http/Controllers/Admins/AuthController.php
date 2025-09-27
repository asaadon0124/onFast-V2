<?php

namespace App\Http\Controllers\Admins;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('admins.auth.auth');
    }


    public function dashboard()
    {

        // $data['new_products'] = Product::select('status_id', 'id','resever_name')->where('status_id', '1')->paginate(2);
        // $data['active_orders'] = Order::select('status', 'id')->where('status', 'active')->count();
        return view('admins.auth.DashBoard');
    }


    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
