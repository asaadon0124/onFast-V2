<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServantsTable extends Migration {

	public function up(): void
	{
		Schema::create('servants', function(Blueprint $blueprint): void {
			$blueprint->increments('id');
			$blueprint->date('created_at');
			$blueprint->date('updated_at');
			$blueprint->string('name', 255);
			$blueprint->string('adress', 255);
			$blueprint->string('phone', 100);
			$blueprint->string('password');
			$blueprint->integer('created_by');
            $blueprint->integer('updated_by');
            $blueprint->enum('status',['active','un_active'])->default('active');


		});
	}

	public function down(): void
	{
		Schema::drop('servants');
	}
}
