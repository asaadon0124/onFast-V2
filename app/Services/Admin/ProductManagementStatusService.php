<?php

namespace App\Services\Admin;

use App\Models\OrderDetailes;
use App\Models\RejectedOrder;
use App\Models\ReturnedOrder;
use App\Models\CollectedOrder;
use App\Admin\ProductManagementStatusInterface;


class ProductManagementStatusService implements ProductManagementStatusInterface
{
    public function find($id)
    {
        return OrderDetailes::with('product', 'adminUpdate')->findOrFail($id);
    }


  



    public function changeStatus($data, OrderDetailes $orderDetailes): OrderDetailes
    {

        $oldStatus = $orderDetailes->product_status; // الحالة القديمة
        $newStatus = $data['product_status'];        // الحالة الجديدة

        $data['updated_by']     = auth('admin')->id();
        $data['coming_from']    = $oldStatus;

        $orderDetailes->update($data);
        $orderDetailes->load('product');

        // تحديث حالة المنتج
        $orderDetailes->product->update(
        [
            'status_id'  => $newStatus,
            'updated_by' => auth('admin')->id(),
            'date'       => now()->toDateString()
        ]);

        // 🧹 1- امسح من الجداول حسب الحالة القديمة
        switch ($oldStatus)
        {
            case 3: // كان مرفوض
                RejectedOrder::where('product_id', $orderDetailes->product_id)->delete();
                break;

            case 4: // كان مرتجع → نمسح ونرجّع type=0
                ReturnedOrder::where('product_id', $orderDetailes->product_id)->delete();
                $orderDetailes->product->update(['type' => 0]);
                break;

            case 6: // كان محصل
                CollectedOrder::where('product_id', $orderDetailes->product_id)->delete();
                break;
        }

        // ➕ 2- ضيف في الجدول الجديد حسب الحالة الجديدة
        switch ($newStatus) {
            case 3: // تم رفضه
                RejectedOrder::updateOrCreate(
                    [
                        'product_id' => $orderDetailes->product_id,
                        'date'       => now()->toDateString(),
                    ],
                    [
                        'supplier_id'       => $orderDetailes->product->supplier_id,
                        'order_detailes_id' => $orderDetailes->id,
                    ]
                );
                break;

            case 4: // مرتجع → أضف ورجّع type=1
                $orderDetailes->product->update(['type' => 1]);
                ReturnedOrder::updateOrCreate(
                    [
                        'product_id' => $orderDetailes->product_id,
                        'date'       => now()->toDateString(),
                    ],
                    [
                        'supplier_id'       => $orderDetailes->product->supplier_id,
                        'order_detailes_id' => $orderDetailes->id,
                    ]
                );
                break;

            case 6: // تم التحصيل
                CollectedOrder::updateOrCreate(
                    [
                        'product_id' => $orderDetailes->product_id,
                        'date'       => now()->toDateString(),
                    ],
                    [
                        'supplier_id'       => $orderDetailes->product->supplier_id,
                        'order_detailes_id' => $orderDetailes->id,
                    ]
                );
                break;
        }

        return $orderDetailes;
    }
}
