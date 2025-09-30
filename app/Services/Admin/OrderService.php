<?php

namespace App\Services\Admin;

use App\Models\Order;
use App\Admin\OrderInterface;
use App\Models\OrderDetailes;

class OrderService implements OrderInterface
{


    public function index($search = null)
    {

        return $data = Order::where(function ($query) use ($search): void {
            $query->where('tracking_number', 'like', '%' . $search . '%')

                ->orWhereHas('servant', function ($q) use ($search): void {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%');
                });
        })->with(['servant', 'orderDetailes', 'adminCreate'])->latest()->paginate(5);
    }




    public function create($data)
    {
        return Order::create($data); // دلوقتي كل القيم متخزنة وموجودة
    }



    public function find($id)
    {
        return Order::findOrFail($id);
    }




    public function update($data, Order $order): Order
    {
        $order->update($data);
        return $order;
    }


   


    public function show(Order $order, $search = null): array
    {
        $builder = OrderDetailes::query()
            ->where('order_id', $order->id)
            ->with([
                 'product' => function ($q): void {
            $q->with(['governorate', 'city', 'supplier']);
        },
        'status',
        'adminUpdate',
        'adminCreate'
            ]);

        if ($search)
        {
            $builder->whereHas('product', function ($q) use ($search): void
            {
                $q->where('resever_name', 'like', "%{$search}%")
                ->orWhere('resver_phone', 'like', "%{$search}%")
                ->orWhere('tracking_number', 'like', "%{$search}%");
            });
        }

        $lengthAwarePaginator = $builder->latest()->paginate(PAGINATION_PER_PAGE);

        return [
            'order' => $order->load(['servant', 'adminCreate']), // eager load order relations
            'data'  => $lengthAwarePaginator,
        ];
    }



    public function delete(Order $order)
    {
        return $order->delete();
    }
}
