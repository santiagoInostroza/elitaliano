<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();  
            $table->bigInteger('quantity');
            $table->bigInteger('quantity_box');
            $table->bigInteger('total_quantity');
            $table->bigInteger('price');
            $table->bigInteger('price_box');
            $table->bigInteger('total_price');
            $table->bigInteger('stock');
           

            $table->unsignedBigInteger('purchase_id');
            $table->unsignedBigInteger('product_id');            
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
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
        Schema::dropIfExists('purchase_items');
    }
}
