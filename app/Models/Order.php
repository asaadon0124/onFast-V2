<?php

namespace App\Models;

use App\StatusTrait;
use App\Models\Admin;
use App\Models\Status;
use App\Models\Servant;
use App\Models\OrderDetailes;
use Illuminate\Database\Eloquent\Model;
use App\Services\Admin\TotalPriceService;

class Order extends Model
{
    use StatusTrait;

    protected $fillable =
    [
        'servant_id',
        'status',
        'coming_from',
        'total_prices',
        'total_servant_profit',
        'total_profit',
        'created_by',
        'updated_by',
        'tracking_number',
        'date',
        'notes'
    ];

    public function servant()
    {
        return $this->belongsTo(Servant::class,'servant_id');
    }

     public function adminCreate()
    {
        return $this->belongsTo(Admin::class,'created_by');
    }


    public function adminUpdate()
    {
        return $this->belongsTo(Admin::class,'updated_by');
    }

    public function orderDetailes()
    {
        return $this->hasMany(OrderDetailes::class,'order_id');
    }


    protected static function booted()
    {


        static::creating(function ($order)
        {

            if (auth('admin')->check())
            {
                $order->created_by        = auth('admin')->id();
                $order->updated_by        = auth('admin')->id();
                $order->date              = now()->toDateString();
            }else
            {
                $order->created_by    = 1;
                $order->updated_by    = 1;
                $order->date             = now()->toDateString();
            }

            $order->coming_from       = 1;
            $order->tracking_number   = self::generateTrackingNumber();
        });

        static::updating(function ($order)
        {
            $order->updated_by    = auth('admin')->id();
        });
    }


    // توليد رقم الشحنة بشكل تلقائي
    protected static function generateTrackingNumber()
    {
        do
        {
            // رقم مكون من 12 خانة أرقام فقط
            $tracking = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        } while
        (self::where('tracking_number', $tracking)->exists());

        return $tracking;
    }
}
