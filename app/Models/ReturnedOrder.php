<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\OrderDetailes;
use Illuminate\Database\Eloquent\Model;

class ReturnedOrder extends Model
{
    protected $fillable =
    [
        'product_id',
        'order_detailes_id',
        'supplier_id',
        'amount',
        'date',
    ];



     public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }


    public function orderDetailes()
    {
        return $this->belongsTo(OrderDetailes::class,'order_detailes_id');
    }
}
