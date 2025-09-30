<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up(): void
	{
		
		
		Schema::table('products', function(Blueprint $blueprint): void {
			$blueprint->foreign('city_id')->references('id')->on('cities')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('products', function(Blueprint $blueprint): void {
			$blueprint->foreign('status_id')->references('id')->on('status')
						->onDelete('no action')
						->onUpdate('no action');
		});
		
		Schema::table('orders', function(Blueprint $blueprint): void {
			$blueprint->foreign('servant_id')->references('id')->on('servants')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('order_detailes', function(Blueprint $blueprint): void {
			$blueprint->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('order_detailes', function(Blueprint $blueprint): void {
			$blueprint->foreign('order_id')->references('id')->on('orders')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down(): void
	{
		Schema::table('cities', function(Blueprint $blueprint): void {
			$blueprint->dropForeign('cities_governorate_id_foreign');
		});
		
		Schema::table('products', function(Blueprint $blueprint): void {
			$blueprint->dropForeign('products_city_id_foreign');
		});
		Schema::table('products', function(Blueprint $blueprint): void {
			$blueprint->dropForeign('products_status_id_foreign');
		});
		
		Schema::table('orders', function(Blueprint $blueprint): void {
			$blueprint->dropForeign('orders_servant_id_foreign');
		});
		Schema::table('order_detailes', function(Blueprint $blueprint): void {
			$blueprint->dropForeign('order_detailes_product_id_foreign');
		});
		Schema::table('order_detailes', function(Blueprint $blueprint): void {
			$blueprint->dropForeign('order_detailes_order_id_foreign');
		});
	}
}