<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Status;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\RejectedOrder;
use App\Models\ReturnedOrder;
use App\Models\CollectedOrder;
use Illuminate\Database\Eloquent\Model;

class OrderDetailes extends Model
{
    protected $fillable =
    [
        'product_id',
        'shipping_price',
        'total_price',
        'order_id',
        'admin_id',
        'product_status',
        'notes',
        'type',
        'coming_from',
        'created_by',
        'updated_by',
        'date'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function adminCreate()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function adminUpdate()
    {
        return $this->belongsTo(Admin::class,'updated_by');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class,'product_status');
    }


    public function returbedStatus()
    {
        return $this->hasMany(ReturnedOrder::class,'order_detailes_id');
    }

    public function collectedStatus()
    {
        return $this->hasMany(CollectedOrder::class,'order_detailes_id');
    }

    public function rejectedStatus()
    {
        return $this->hasMany(RejectedOrder::class,'order_detailes_id');
    }


       protected static function booted()
    {


        static::creating(function ($orderDetailes)
        {

            if (auth('admin')->check())
            {
                $orderDetailes->created_by        = auth('admin')->id();
                $orderDetailes->updated_by        = auth('admin')->id();
            }else
            {
                $orderDetailes->created_by    = 1;
                $orderDetailes->updated_by    = 1;
            }

            $orderDetailes->product_status          = 2;
            $orderDetailes->admin_id                = auth('admin')->id();
        });

        static::updating(function ($orderDetailes)
        {
            $orderDetailes->updated_by    = auth('admin')->id();
        });


        static::deleting(function ($orderDetailes)
        {
            if ($orderDetailes->product)
            {
                $orderDetailes->product->update(
                [
                    'status_id'  => 1,
                    'updated_by' => auth('admin')->id(),
                    'date'       => now()->toDateString()
                ]);
            }
        });

    }
}
