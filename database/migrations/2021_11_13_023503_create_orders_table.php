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

            $table->foreignId('food_menu_type')
                ->references('id')
                ->on('food_menu_types')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->integer('amount');

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

            $table->foreignId('order_delivery')
                ->references('id')
                ->on('order_deliveries')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('order_status')
                ->references('id')
                ->on('order_statuses')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

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
