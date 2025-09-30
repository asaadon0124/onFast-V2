<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReserveOrdersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reserve_orders', function (Blueprint $blueprint): void {
            $blueprint->id();
            $blueprint->integer('product_id');
            $blueprint->integer('status_id')->nullable();
            $blueprint->integer('reserve_id')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserve_orders');
    }
}
