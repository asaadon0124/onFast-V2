<?php

namespace App\Admin;

interface AdminAuthInterface
{
        public function login($data);
        public function logout();
}
