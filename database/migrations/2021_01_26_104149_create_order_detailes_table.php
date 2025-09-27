<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailesTable extends Migration {

	public function up()
	{
		Schema::create('order_detailes', function(Blueprint $table) {
			$table->increments('id');
            $table->timestamps();
            $table->integer('product_id')->unsigned();
			$table->integer('shipping_price')->unsigned()->default(0);
			$table->integer('total_price')->unsigned()->default(0);
			$table->integer('order_id')->unsigned()->nullable();
			$table->integer('admin_id')->unsigned()->nullable();
			$table->string('product_status', 255);
			$table->text('notes')->nullable();
            $table->integer('type')->default(0);        // في حالة المرتجع  == 1
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->date('date')->nullable();
            $table->boolean('coming_from')->default(0);


			$table->softDeletes();


		});
	}

	public function down()
	{
		Schema::drop('order_detailes');
	}
}
