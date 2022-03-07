<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('total');
            $table->integer('payment_amount')->nullable();
            $table->tinyInteger('payment_status'); // 1 pendiente  2 abonado  3 pagado
            $table->integer('pending_amount')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->date('date');

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('purchases');
    }
}
