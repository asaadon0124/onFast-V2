<?php

namespace App\Services\Admin;

use App\Models\Admin;
use App\Models\Product;
use App\Models\Servant;
use App\Models\OrderDetailes;
use Illuminate\Support\Facades\DB;
use App\Admin\RebortServantInterface;

class RebortServantService implements RebortServantInterface
{


    public function getServants()
    {
        $servants = Servant::select('name', 'id')->get();
        return $servants;
    }




    public function getAllOrderDetailes($status = null, $search = null, $filters = [])
    {
        $get_order_detailes = OrderDetailes::with(['product.supplier', 'product.governorate', 'product.city', 'status', 'adminUpdate'])
            ->whereIn('id', function ($query)
            {
                $query->select(DB::raw('MAX(id)'))
                    ->from('order_detailes')
                    ->groupBy('product_id'); // مش order_id
            });

        if ($status)
        {
            $get_order_detailes->where('product_status', $status);
        }



        if (!empty($search))
        {
            $get_order_detailes->whereHas('product', function ($q) use ($search)
            {
                $q->where('tracking_number', 'like', "%{$search}%")
                ->orWhere('resever_name', 'like', "%{$search}%")
                ->orWhere('resver_phone', 'like', "%{$search}%");
            });
        }

        $get_order_detailes = $this->filterAllOrderDetailes($get_order_detailes, $filters);
        return $get_order_detailes->latest()->paginate(2);
    }










    public function filterAllOrderDetailes($query, $filters = [])
    {
        // فلترة بالمورد
        if (!empty($filters['servant_id']))
        {
            $query->whereHas('order', function ($q) use ($filters)
            {
                $q->where('servant_id', $filters['servant_id']);
            });
        }

        // فلترة بالتاريخ
        if (!empty($filters['start_date']) && !empty($filters['end_date']))
        {
            $query->whereDate('created_at', '>=', $filters['start_date'])->whereDate('created_at', '<=', $filters['end_date']);
        }

        return $query;
    }















}
