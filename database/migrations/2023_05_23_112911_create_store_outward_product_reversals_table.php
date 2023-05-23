<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreOutwardProductReversalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_outward_product_reversals', function (Blueprint $table) {
            $table->id();
            $table->integer('store_product_id')->constrained()->nullable();
            $table->integer('outward_id')->constrained()->nullable();
            $table->integer('reversal_quantity')->nullable();
            $table->integer('created_by')->constrained()->nullable();
            $table->integer('updated_by')->constrained()->nullable();
            $table->integer('deleted_by')->constrained()->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('store_outward_product_reversals');
    }
}
