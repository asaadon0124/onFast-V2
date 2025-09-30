<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Admin\AdminAuthInterface;

class Auth extends Component
{
    public $email;
    public $password;
    public $remember = false;


    protected AdminAuthInterface $AuthAdminService;

    public function boot(AdminAuthInterface $adminAuth): void
    {
        $this->AuthAdminService = $adminAuth;
    }


    public function login()
    {
        $data =
        [
            'email'         => $this->email,
            'password'      => $this->password,
            'remember_me'   => $this->remember,
        ];

        if ($this->AuthAdminService->login($data))
        {
            session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        $this->addError('email', 'بيانات الدخول غير صحيحة');
        return null;
    }



    public function render()
    {
        return view('livewire.admin.auth');
    }
}
