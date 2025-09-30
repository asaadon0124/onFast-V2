<?php

namespace App\Services\Admin;



class TotalPriceService
{
    public function calculate($product_price, $shipping_price,$discount = 0): int|float
    {
        $product_price ??= 0;
        $shipping_price ??= 0;
        $discount ??= 0;

        return ($product_price + $shipping_price) - $discount;
    }

    // public function calculateTotalProfit($product_price, $shipping_price,$discount = 0)
    // {
    //     $product_price  = $product_price ?? 0;
    //     $shipping_price = $shipping_price ?? 0;
    //     $discount      = $discount ?? 0;

    //     return ($product_price + $shipping_price) - $discount;
    // }

    // public function calculateTotalProfitServant($product_price, $shipping_price,$discount = 0)
    // {
    //     $product_price  = $product_price ?? 0;
    //     $shipping_price = $shipping_price ?? 0;
    //     $discount      = $discount ?? 0;

    //     return ($product_price + $shipping_price) - $discount;
    // }
}
