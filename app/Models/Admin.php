<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory;
    // use HasRoles;
    protected $table        = 'admins';
    protected $fillable     =
    [
        'name',
        'phone',
        'email',
        'password',
    ];
}
