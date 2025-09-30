<?php

namespace App\Models;

use App\StatusTrait;
use App\Models\Admin;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class Servant extends Model
{
    use StatusTrait;
    protected $fillable =
    [
        'name',
        'adress',
        'phone',
        'password',
        'created_by',
        'updated_by',
        'status',
    ];


     public function adminCreate()
    {
        return $this->belongsTo(Admin::class,'created_by');
    }


    public function adminUpdate()
    {
        return $this->belongsTo(Admin::class,'updated_by');
    }


     protected static function booted()
    {
       static::addGlobalScope(new ActiveScope);


        static::creating(function ($servant): void
        {
            if (auth('admin')->check())
            {
                $servant->created_by = auth('admin')->id();
                $servant->updated_by = auth('admin')->id();
            }else
            {
                $servant->created_by = 1;
                $servant->updated_by = 1;
            }
        });

        static::updating(function ($servant): void
        {
            $servant->updated_by = auth('admin')->id();
        });
    }
}
