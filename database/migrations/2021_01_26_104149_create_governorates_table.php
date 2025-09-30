<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGovernoratesTable extends Migration {

	public function up(): void
	{
		Schema::create('governorates', function(Blueprint $blueprint): void
        {
			$blueprint->increments('id');
			$blueprint->timestamps();
			$blueprint->string('name', 100);
             $blueprint->enum('status',['active','un_active'])->default('active');
            $blueprint->integer('created_by');
            $blueprint->integer('updated_by');
            $blueprint->date('date')->nullable();
		});
	}

	public function down(): void
	{
		Schema::drop('governorates');
	}
}
