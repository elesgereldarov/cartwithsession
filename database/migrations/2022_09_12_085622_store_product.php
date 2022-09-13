<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoreProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_product', function (Blueprint $table) {

            $table->integer('product_id')->unsigned();
        
            $table->integer('store_id')->unsigned();
        
            $table->foreign('product_id')->references('id')->on('products')
        
                ->onDelete('cascade');
        
            $table->foreign('store_id')->references('id')->on('stores')
        
                ->onDelete('cascade');
        
        });   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_product');
    }
}
