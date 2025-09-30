<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	public function up(): void
	{
		Schema::create('products', function(Blueprint $blueprint): void {
			$blueprint->increments('id');
			$blueprint->timestamps();
			$blueprint->date('rescive_date');
			$blueprint->string('resever_name', 100);
            $blueprint->string('resver_phone', 20);
			$blueprint->string('resver_address', 255);
			$blueprint->integer('supplier_id')->unsigned();
			$blueprint->integer('governorate_id')->unsigned();
			$blueprint->integer('city_id')->unsigned();
			$blueprint->decimal('product_price', 10, 2);
            $blueprint->decimal('shipping_price', 10, 2);
            $blueprint->decimal('total_price', 10, 2);
			$blueprint->integer('status_id')->unsigned()->default(1);
			$blueprint->integer('user_id')->unsigned()->nullable();
			$blueprint->string('tracking_number',100);
            $blueprint->unsignedBigInteger('created_by');
            $blueprint->unsignedBigInteger('updated_by');
            $blueprint->enum('status',['active','un_active'])->default('active');
            $blueprint->date('date')->nullable();
			$blueprint->text('notes')->nullable();
		});
	}

	public function down(): void
	{
		Schema::drop('products');
	}
}
