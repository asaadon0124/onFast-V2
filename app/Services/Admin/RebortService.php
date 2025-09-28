<?php

namespace App\Services\Admin;

use App\Models\Admin;
use App\Models\Product;
use App\Models\Servant;
use App\Models\Supplier;
use App\Models\OrderDetailes;
use App\Admin\RebortInterface;
use Illuminate\Support\Facades\DB;

class RebortService implements RebortInterface
{


    public function getSuppliers()
    {
        $suppliers = Supplier::select('name', 'id')->get();
        return $suppliers;
    }







public function getNewProducts($search = null, $filters = [])
{
    $newProducts = Product::where('status_id', 1)
        ->where(function ($query) use ($search)
        {
            if (!empty($search))
            {
                $query->where('tracking_number', 'like', '%' . $search . '%')
                    ->orWhere('resever_name', 'like', '%' . $search . '%');
            }
        });

    // هنا نستدعي فلتر الخدمة
    $newProducts = $this->filterNewProducts($newProducts, $filters);

    return
    [
        'newProducts'   => $newProducts->latest()->paginate(5),
        'total_prices'  => $newProducts->sum('product_price'),
    ];
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






    // FILTERS FUNCTIONS
    public function filterNewProducts($query, $filters = [])
    {
        // فلترة بالمورد
        if (!empty($filters['supplier_id']))
        {
            $query->where('supplier_id', $filters['supplier_id']);
        }

        // فلترة بالتاريخ
        if (!empty($filters['start_date']) && !empty($filters['end_date']))
        {
            $query->whereDate('created_at', '>=', $filters['start_date'])->whereDate('created_at', '<=', $filters['end_date']);
        }

        return $query;
    }




    public function filterAllOrderDetailes($query, $filters = [])
    {
        // فلترة بالمورد
        if (!empty($filters['supplier_id']))
        {
            $query->whereHas('product', function ($q) use ($filters)
            {
                $q->where('supplier_id', $filters['supplier_id']);
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
