<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cart')
                ->references('id')
                ->on('food_menu_types')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('food_menu_type')
                ->references('id')
                ->on('food_menu_types')
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
        Schema::dropIfExists('cart_details');
    }
}
