<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderReturnStatusesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_return_statuses', function (Blueprint $blueprint): void {
            $blueprint->increments('id');
            $blueprint->integer('order_detailes_id')->unsigned()->nullable();
            $blueprint->integer('returns_id')->unsigned()->nullable();
            $blueprint->integer('status_id')->unsigned();
            $blueprint->string('package_number');
            $blueprint->timestamps();
            $blueprint->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_return_statuses');
    }
}
