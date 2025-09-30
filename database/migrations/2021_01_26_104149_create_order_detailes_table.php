<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailesTable extends Migration {

	public function up(): void
	{
		Schema::create('order_detailes', function(Blueprint $blueprint): void {
			$blueprint->increments('id');
            $blueprint->timestamps();
            $blueprint->integer('product_id')->unsigned();
			$blueprint->integer('shipping_price')->unsigned()->default(0);
			$blueprint->integer('total_price')->unsigned()->default(0);
			$blueprint->integer('order_id')->unsigned()->nullable();
			$blueprint->integer('admin_id')->unsigned()->nullable();
			$blueprint->string('product_status', 255);
			$blueprint->text('notes')->nullable();
            $blueprint->integer('type')->default(0);        // في حالة المرتجع  == 1
            $blueprint->unsignedBigInteger('created_by');
            $blueprint->unsignedBigInteger('updated_by');
            $blueprint->date('date')->nullable();
            $blueprint->boolean('coming_from')->default(0);


			$blueprint->softDeletes();


		});
	}

	public function down(): void
	{
		Schema::drop('order_detailes');
	}
}
