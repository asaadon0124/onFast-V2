<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $fillable =
    [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'status_id');
    }
}
