<?php

namespace App\Services\Admin;

use App\Models\OrderDetailes;
use App\Admin\OrderDetailesInterface;

class OrderDetailesService implements OrderDetailesInterface
{

    // public function create($data)
    // {
    //     $orderDetailes = OrderDetailes::create($data);
    //     return $orderDetailes; // دلوقتي كل القيم متخزنة وموجودة
    // }


public function create($data, $orderId, $selectedProduct)
{
    $data['order_id']       = $orderId;
    $data['shipping_price'] = $selectedProduct->shipping_price;
    $data['product_price']  = $selectedProduct->product_price;
    $data['total_price']    = $selectedProduct->total_price;
    $data['coming_from']    = $selectedProduct->status_id;

    $selectedProduct->update(
    [
        'status_id' => 2,
        'updated_by' => auth('admin')->id()
    ]);

    return OrderDetailes::create($data);
}



    public function find($id)
    {
        return OrderDetailes::with('product','adminUpdate')->findOrFail($id);
    }





    public function update($data, OrderDetailes $orderDetailes)
    {
        $data['updated_by']     = auth('admin')->id();

        if ($data['product_id'] != $orderDetailes->product_id)
        {
            // UPDATE OLD PRODUCT
            $oldProduct = $orderDetailes->product;
            $oldProduct->update(
            [
                'status_id' => 1,
                'updated_by' => auth('admin')->id()
            ]);
        }
        $orderDetailes->update($data);
        $orderDetailes->load('product');

        // UPDATE NEW PRODUCT
        $orderDetailes->product->update(
        [
            'status_id'         => 2,
            'updated_by'        => auth('admin')->id()
        ]);
        return $orderDetailes;
    }


    public function show(OrderDetailes $orderDetailes, $search = null)
    {
        // $query = OrderDetailes::where('order_id', $order->id);

        // if ($search) {
        //     $query->whereHas('product', function ($q) use ($search) {
        //         $q->where('resever_name', 'like', '%' . $search . '%')
        //             ->orWhere('resver_phone', 'like', '%' . $search . '%')
        //             ->orWhere('tracking_number', 'like', '%' . $search . '%');
        //     });
        // }

        // $data = $query->with(['product', 'supplier', 'adminUpdate', 'adminCreate'])->latest()->paginate(5);

        // return [
        //     'order' => $order,
        //     'data' => $data,
        // ];
    }


    public function delete(OrderDetailes $orderDetailes)
    {
        return $orderDetailes->delete();
    }
}
