<?php

namespace App\Services\Admin;

use App\Models\Admin;
use App\Admin\AdminAuthInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class AuthAdminService implements AdminAuthInterface
{


    public function login($data): bool
    {
        $remember_me = $data['remember_me'] ?? false;

        $admin = Admin::where('email', $data['email'])->first();

        if (! $admin || ! Hash::check($data['password'], $admin->password)) {
            return false;
        }

        Auth::guard('admin')->login($admin, $remember_me);

        return true; // <-- لازم ترجع true هنا
    }

    public function logout(): bool
    {
        Auth::guard('admin')->logout();
        return true;
    }
}
