<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderToppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_toppings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order')
                ->references('id')
                ->on('orders')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('food_topping')
                ->references('id')
                ->on('food_toppings')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->integer('amount');

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
        Schema::dropIfExists('order_toppings');
    }
}
