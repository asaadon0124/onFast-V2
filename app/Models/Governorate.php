<?php

namespace App\Models;

use App\Models\City;
use App\StatusTrait;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use StatusTrait;


    protected $fillable =
    [
        'name',
        'status',
        'created_by',
        'updated_by',
        'date'
    ];




    public function adminCreate()
    {
        return $this->belongsTo(Admin::class,'created_by');
    }

    public function adminUpdate()
    {
        return $this->belongsTo(Admin::class,'updated_by');
    }

    public function cities()
    {
        return $this->hasMany(City::class,'governorate_id');
    }


    protected static function booted()
    {
       static::addGlobalScope(new ActiveScope);
    }


}
