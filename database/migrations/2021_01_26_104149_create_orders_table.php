<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
            $table->timestamps();
			$table->integer('servant_id')->unsigned();
            $table->enum('status',['active','un_active'])->default('active');
			$table->boolean('coming_from')->default(0);
			$table->integer('total_prices')->unsigned()->default('0');
			$table->integer('total_servant_profit')->unsigned()->default('0');
			$table->integer('total_profit')->unsigned()->default('0');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->string('tracking_number',100);
            $table->date('date')->nullable();
			$table->text('notes')->nullable();
			$table->softDeletes();

		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
