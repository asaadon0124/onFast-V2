<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('returned_orders', function (Blueprint $blueprint): void {
            $blueprint->id();
            $blueprint->integer('product_id')->unsigned();
            $blueprint->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $blueprint->integer('order_detailes_id')->unsigned();
            $blueprint->foreign('order_detailes_id')->references('id')->on('order_detailes')->onDelete('cascade');
            $blueprint->integer('supplier_id')->unsigned();
            $blueprint->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $blueprint->date('date'); // تاريخ المرتجع
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returned_orders');
    }
};
