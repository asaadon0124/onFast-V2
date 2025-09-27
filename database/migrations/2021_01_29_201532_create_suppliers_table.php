<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
			$table->date('created_at');
			$table->date('updated_at');
			$table->string('name', 255);
			$table->integer('governorate_id');
			$table->integer('city_id');
             $table->enum('status',['active','un_active'])->default('active');
            $table->integer('created_by');
            $table->integer('updated_by');
			$table->string('adress', 255);
			$table->string('phone', 100);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
