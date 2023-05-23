<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_products', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id')->constrained()->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_name')->nullable();
            $table->text('product_description')->nullable();
            $table->string('product_image')->nullable();
            $table->integer('product_category_id')->constrained()->nullable();
            $table->integer('current_stock')->nullable();
            $table->decimal('min_price',18,2)->default(0.0);
            $table->decimal('max_price',18,2)->default(0.0);
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
        Schema::dropIfExists('store_products');
    }
}
