<?php

namespace App\Models;

use App\StatusTrait;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use StatusTrait;
    protected $fillable =
    [
        'name',
        'governorate_id',
        'status',
        'created_by',
        'updated_by',
        'date'
    ];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class,'governorate_id');
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


        static::creating(function ($city): void
        {
            if (auth('admin')->check())
            {
                 $city->created_by = auth('admin')->id();
                $city->updated_by = auth('admin')->id();
                $city->date       = now()->toDateString();
            }else
            {
                $city->created_by = 1;
                $city->updated_by = 1;
                $city->date       = now()->toDateString();
            }


        });

        static::updating(function ($city): void
        {
            $city->updated_by = auth('admin')->id();

        });
    }







}
