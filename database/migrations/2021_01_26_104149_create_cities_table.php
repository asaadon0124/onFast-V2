<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration {

	public function up()
	{
		Schema::create('cities', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 100)->unique();
			$table->integer('governorate_id')->unsigned();
            $table->enum('status',['active','un_active'])->default('active');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->date('date')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('cities');
	}
}
