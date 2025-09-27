<?php

namespace App\Services\Admin;

use DB;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetailes;
use App\Admin\DashboardInterface;

class DashboardService implements DashboardInterface
{
    public function getNewProducts($search = null)
    {
        return Product::select('status_id', 'id',)->where('status_id', 1)->get()->count();
    }

     public function getOrderDetailes($search = null)
    {
        $query = Product::with(['supplier', 'governorate', 'city', 'statusRelation', 'adminCreate'])
            ->latest()
            ->whereHas('orderDetailes')
            ->where('status_id','<>', 1);

        $search = trim($search); // هنا بقص أي مسافات زيادة

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('resever_name', 'like', '%' . $search . '%')
                    ->orWhere('resver_phone', 'like', '%' . $search . '%')
                    ->orWhere('tracking_number', 'like', '%' . $search . '%')
                    ->orWhere('resver_address', 'like', '%' . $search . '%')
                    ->orWhereHas('supplier', function ($subQ) use ($search) {
                        $subQ->where('name', 'like', '%' . $search . '%')
                            ->orWhere('phone', 'like', '%' . $search . '%');
                    });
            });
        }

        return $query->paginate(2);
    }



public function getProductsWithDetails($search = null)
{
    $query = Product::with([
        'supplier',
        'governorate',
        'city',
        'statusRelation',
        'adminCreate',
        'lastOrderDetail',
        'statusRelation'
    ])
        ->latest()
        ->where(function ($q) {
            $q->where('status_id', 1) // منتجات جديدة
              ->orWhere(function ($subQ) {
                  $subQ->where('status_id', '<>', 1) // مش جديدة
                       ->whereHas('orderDetailes'); // بس لو ليها تفاصيل
              });
        });

    $search = trim($search);

    if ($search !== '') {
        $query->where(function ($q) use ($search) {
            $q->where('resever_name', 'like', '%' . $search . '%')
                ->orWhere('resver_phone', 'like', '%' . $search . '%')
                ->orWhere('tracking_number', 'like', '%' . $search . '%')
                ->orWhere('resver_address', 'like', '%' . $search . '%')
                ->orWhereHas('supplier', function ($subQ) use ($search) {
                    $subQ->where('name', 'like', '%' . $search . '%')
                         ->orWhere('phone', 'like', '%' . $search . '%');
                });
        });
    }

    return $query->paginate(2);
}






    public function getActiveOrdersCount()
    {
        return Order::select('status', 'id')->where('status', 'active')->count();
    }


// public function getAllShipments($search = null)
// {
//     // الشحنات الجديدة
//     $products = Product::select(
//         'products.id',
//         'products.tracking_number',
//         'products.resever_name',
//         'products.resver_phone',
//         'products.resver_address',
//         'products.status_id',
//         'suppliers.name as supplier_name',
//         'suppliers.phone as supplier_phone'
//     )
//         ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.id')
//         ->where('products.status_id', 1);

//     // شحنات خط السير
//     $orderDetails = OrderDetailes::select(
//         'order_detailes.id',
//         'products.tracking_number',
//         'products.resever_name',
//         'products.resver_phone',
//         'products.resver_address',
//         'order_detailes.product_status as status_id',
//         'suppliers.name as supplier_name',
//         'suppliers.phone as supplier_phone'
//     )
//         ->leftJoin('products', 'order_detailes.product_id', '=', 'products.id')
//         ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.id');

//     // دمج
//     $unionQuery = $products->unionAll($orderDetails);

//     $query = \DB::table(\DB::raw("({$unionQuery->toSql()}) as shipments"))
//         ->mergeBindings($products->getQuery())
//         ->mergeBindings($orderDetails->getQuery())
//         ->orderBy('id', 'desc');

//     // البحث
//     if (!empty($search)) {
//         $query->where(function ($q) use ($search) {
//             $q->where('shipments.resever_name', 'like', "%$search%")
//                 ->orWhere('shipments.resver_phone', 'like', "%$search%")
//                 ->orWhere('shipments.tracking_number', 'like', "%$search%")
//                 ->orWhere('shipments.resver_address', 'like', "%$search%")
//                 ->orWhere('shipments.supplier_name', 'like', "%$search%")
//                 ->orWhere('shipments.supplier_phone', 'like', "%$search%");
//         });
//     }

//     return $query->paginate(10);
// }


}
