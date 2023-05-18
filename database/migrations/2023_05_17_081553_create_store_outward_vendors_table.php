<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreOutwardVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_outward_vendors', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id')->constrained()->nullable();
            $table->string('vendor_name');
            $table->text('vendor_description');
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
        Schema::dropIfExists('store_outward_vendors');
    }
}
