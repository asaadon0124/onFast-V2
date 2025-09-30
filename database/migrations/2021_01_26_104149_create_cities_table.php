<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration {

	public function up(): void
	{
		Schema::create('cities', function(Blueprint $blueprint): void {
			$blueprint->increments('id');
			$blueprint->timestamps();
			$blueprint->string('name', 100)->unique();
			$blueprint->integer('governorate_id')->unsigned();
            $blueprint->enum('status',['active','un_active'])->default('active');
            $blueprint->integer('created_by');
            $blueprint->integer('updated_by');
            $blueprint->date('date')->nullable();
		});
	}

	public function down(): void
	{
		Schema::drop('cities');
	}
}
