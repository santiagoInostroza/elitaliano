<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->bigInteger('total');
            $table->date('date');
            $table->integer('payment_amount')->nullable();
            $table->integer('payment_status'); // 1 pendiente  2 abonado  3 pagado
            $table->integer('pending_amount')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->integer('delivery')->default(0); // 0 no, 1 si
            $table->date('delivery_date')->nullable();
            $table->dateTime('date_delivered')->nullable();
            $table->integer('delivery_stage')->nullable();// etapa de entrega  0= por entregar\n1= entregado
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->integer('cost')->nullable();
            $table->integer('stage')->default(0); //  pedido = 1 / venta = 2 / anulada = 3

            $table->unsignedBigInteger('delivered_by')->nullable();
            $table->integer('delivery_value')->nullable();

            $table->integer('subtotal');

            $table->integer('invoice_delivered')->default(0); //boleta entregada
            $table->dateTime('invoice_delivered_date')->nullable();// fecha de boleta entregada
            $table->integer('invoice_delivered_by')->nullable();//boleta entregada por

            $table->integer('sale_type')->default(1);// 1 normal, 2 online, 3 especial

            $table->integer('payment_account')->nullable(); //Cuenta de pago

            // $table->integer('user_modificate');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('sales');
    }
}
