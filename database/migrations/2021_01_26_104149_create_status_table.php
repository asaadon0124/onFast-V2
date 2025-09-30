<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTable extends Migration {

	public function up(): void
	{
		Schema::create('status', function(Blueprint $blueprint): void {
			$blueprint->increments('id');
			$blueprint->timestamps();
			$blueprint->string('name', 255);
		});
	}

	public function down(): void
	{
		Schema::drop('status');
	}
}
