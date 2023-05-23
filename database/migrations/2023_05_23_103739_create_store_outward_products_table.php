<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreOutwardProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_outward_products', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id')->constrained()->nullable();
            $table->integer('store_product_id')->constrained()->nullable();
            $table->integer('store_outward_vendor_id')->constrained()->nullable();
            $table->integer('stock_outward');
            $table->integer('outward_by')->constrained()->nullable();
            $table->string('outward_image')->nullable();
            $table->integer('approve_by')->constrained()->nullable();
            $table->string('outward_person')->nullable();
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
        Schema::dropIfExists('store_outward_products');
    }
}
