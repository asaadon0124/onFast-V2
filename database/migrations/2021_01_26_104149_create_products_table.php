<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->date('rescive_date');
			$table->string('resever_name', 100);
            $table->string('resver_phone', 20);
			$table->string('resver_address', 255);
			$table->integer('supplier_id')->unsigned();
			$table->integer('governorate_id')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->decimal('product_price', 10, 2);
            $table->decimal('shipping_price', 10, 2);
            $table->decimal('total_price', 10, 2);
			$table->integer('status_id')->unsigned()->default(1);
			$table->integer('user_id')->unsigned()->nullable();
			$table->string('tracking_number',100);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->enum('status',['active','un_active'])->default('active');
            $table->date('date')->nullable();
			$table->text('notes')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
