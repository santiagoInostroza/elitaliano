<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('quantity');
            $table->BigInteger('quantity_box');
            $table->BigInteger('total_quantity');
            
            $table->BigInteger('price');
            $table->BigInteger('price_box');
            $table->BigInteger('total_price');

            $table->integer('cost')->nullable();
            $table->integer('total_cost')->nullable();

            $table->integer('difference')->nullable();
            $table->integer('total_difference')->nullable();

        
            
            $table->unsignedBigInteger('purchase_item_id');
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('purchase_item_id')->references('id')->on('purchase_items')->onDelete('cascade');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_items');
    }
}
