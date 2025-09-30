<?php

namespace App\Models;

use App\Models\City;
use App\StatusTrait;
use App\Models\Admin;
use App\Models\Governorate;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use StatusTrait;
      protected $fillable =
    [
        'name',
        'governorate_id',
        'city_id',
        'status',
        'created_by',
        'updated_by',
        'adress',
        'phone',
    ];


    public function governorate()
    {
        return $this->belongsTo(Governorate::class,'governorate_id');
    }


    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

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


        static::creating(function ($supplier): void
        {
            if (auth('admin')->check())
            {
                $supplier->created_by = auth('admin')->id();
                $supplier->updated_by = auth('admin')->id();
            }else
            {
                $supplier->created_by = 1;
                $supplier->updated_by = 1;
            }
        });

        static::updating(function ($supplier): void
        {
            $supplier->updated_by = auth('admin')->id();
        });
    }
}
