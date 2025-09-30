<?php

namespace App\Models;

use App\Models\City;
use App\StatusTrait;
use App\Models\Admin;
use App\Models\Status;
use App\Models\Supplier;
use App\Models\Governorate;
use App\Models\OrderDetailes;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use App\Services\Admin\TotalPriceService;

class Product extends Model
{
    use StatusTrait;

    protected $fillable =
    [
        'rescive_date',
        'resever_name',
        'resver_phone',
        'resver_address',
        'supplier_id',
        'governorate_id',
        'city_id',
        'product_price',
        'shipping_price',
        'total_price',
        'status_id',
        'user_id',
        'tracking_number',
        'created_by',
        'updated_by',
        'notes',
        'status',
        'type',
        'date'
    ];



    public function governorate()
    {
        return $this->belongsTo(Governorate::class,'governorate_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function statusRelation()
    {
        return $this->belongsTo(Status::class,'status_id');
    }


    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
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
        return $this->hasMany(OrderDetailes::class,'product_id');
    }

    public function lastOrderDetail()
    {
        return $this->hasOne(OrderDetailes::class, 'product_id')->latestOfMany();
    }


    


    protected static function booted()
    {
       static::addGlobalScope(new ActiveScope);


        static::creating(function ($product): void
        {

            $totalPriceService = app(TotalPriceService::class);
            if (auth('admin')->check())
            {
                $product->created_by        = auth('admin')->id();
                $product->updated_by        = auth('admin')->id();
            }else
            {
                $product->created_by = 1;
                $product->updated_by = 1;
            }

            $product->status_id         = 1;
            $product->tracking_number   = self::generateTrackingNumber();
            $product->total_price       = $totalPriceService->calculate($product->product_price,$product->shipping_price);
        });

        static::updating(function ($product): void
        {
            $totalPriceService             = app(TotalPriceService::class);
            $product->updated_by    = auth('admin')->id();
            $product->date          = now()->toDateString();
            $product->total_price   = $totalPriceService->calculate($product->product_price,$product->shipping_price);
        });
    }


    // توليد رقم الشحنة بشكل تلقائي
    protected static function generateTrackingNumber(): string
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
