<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $blueprint): void {
            $blueprint->increments('id');
			$blueprint->date('created_at');
			$blueprint->date('updated_at');
			$blueprint->string('name', 255);
			$blueprint->integer('governorate_id');
			$blueprint->integer('city_id');
             $blueprint->enum('status',['active','un_active'])->default('active');
            $blueprint->integer('created_by');
            $blueprint->integer('updated_by');
			$blueprint->string('adress', 255);
			$blueprint->string('phone', 100);
            $blueprint->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
}
