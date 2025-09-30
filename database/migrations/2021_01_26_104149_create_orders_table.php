<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	public function up(): void
	{
		Schema::create('orders', function(Blueprint $blueprint): void {
			$blueprint->increments('id');
            $blueprint->timestamps();
			$blueprint->integer('servant_id')->unsigned();
            $blueprint->enum('status',['active','un_active'])->default('active');
			$blueprint->boolean('coming_from')->default(0);
			$blueprint->integer('total_prices')->unsigned()->default('0');
			$blueprint->integer('total_servant_profit')->unsigned()->default('0');
			$blueprint->integer('total_profit')->unsigned()->default('0');
            $blueprint->unsignedBigInteger('created_by');
            $blueprint->unsignedBigInteger('updated_by');
            $blueprint->string('tracking_number',100);
            $blueprint->date('date')->nullable();
			$blueprint->text('notes')->nullable();
			$blueprint->softDeletes();

		});
	}

	public function down(): void
	{
		Schema::drop('orders');
	}
}
