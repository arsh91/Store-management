<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreInwardProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_inward_products', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id')->constrained()->nullable();
            $table->integer('store_product_id')->constrained()->nullable();
            $table->integer('store_inward_vendor_id')->constrained()->nullable();
            $table->integer('stock_inward');
            $table->integer('inward_by')->constrained()->nullable();
            $table->decimal('product_price',18,2)->default(0.0);
            $table->decimal('total_amount',18,2)->default(0.0);
            $table->integer('bill_no');
            $table->string('bill_image');
            $table->string('inward_person_from');
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
        Schema::dropIfExists('store_inward_products');
    }
}
