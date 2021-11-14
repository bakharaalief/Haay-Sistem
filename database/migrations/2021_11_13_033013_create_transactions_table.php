<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order')
                ->references('id')
                ->on('orders')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->bigInteger('total_menu_price');
            $table->bigInteger('total_topping_price');
            $table->bigInteger('total_delivery_price');
            $table->text('bukti_transfer');
            $table->boolean('status_bayar')->default(false);
            $table->boolean('delete')->default(false);
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
        Schema::dropIfExists('transactions');
    }
}
