<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServantsTable extends Migration {

	public function up()
	{
		Schema::create('servants', function(Blueprint $table) {
			$table->increments('id');
			$table->date('created_at');
			$table->date('updated_at');
			$table->string('name', 255);
			$table->string('adress', 255);
			$table->string('phone', 100);
			$table->string('password');
			$table->integer('created_by');
            $table->integer('updated_by');
            $table->enum('status',['active','un_active'])->default('active');


		});
	}

	public function down()
	{
		Schema::drop('servants');
	}
}
