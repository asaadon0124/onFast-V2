<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnsDetailesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('returns_detailes', function (Blueprint $blueprint): void {
            $blueprint->increments('id');
			$blueprint->date('created_at');
			$blueprint->date('updated_at');
			$blueprint->integer('returns_id')->unsigned();
			$blueprint->integer('shipping_price')->unsigned()->default(0);
			$blueprint->integer('total_price')->unsigned()->default(0);
			$blueprint->integer('order_id')->unsigned()->nullable();
			$blueprint->string('product_status', 255);
			$blueprint->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns_detailes');
    }
}
