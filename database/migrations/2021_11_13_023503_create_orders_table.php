<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user')
                ->references('id')
                ->on('users')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('phone')
                ->references('id')
                ->on('phones')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('address')
                ->references('id')
                ->on('addresses')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('order_process_time')
                ->references('id')
                ->on('order_process_times')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->bigInteger('order_process_price_now');

            $table->foreignId('order_delivery')
                ->references('id')
                ->on('order_deliveries')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->bigInteger('order_delivery_price_now');

            $table->text('bukti_transfer')->nullable(true);

            $table->foreignId('order_status')
                ->references('id')
                ->on('order_statuses')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->bigInteger('total_price');

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
        Schema::dropIfExists('orders');
    }
}
