<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('returns', function (Blueprint $blueprint): void {
            $blueprint->increments('id');
			$blueprint->date('created_at');
			$blueprint->date('updated_at');
			$blueprint->date('rescive_date');
			$blueprint->string('resever_name', 100);
			$blueprint->string('resver_phone', 100)->unique();
			$blueprint->integer('supplier_id')->unsigned();
			$blueprint->integer('city_id')->unsigned();
			$blueprint->string('adress', 255);
			$blueprint->integer('product_price')->unsigned();
			$blueprint->integer('status_id')->unsigned()->default(0);
			$blueprint->integer('order_id')->unsigned()->default(0);
			$blueprint->string('package_number');
            $blueprint->text('notes')->nullable();
            $blueprint->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
}
