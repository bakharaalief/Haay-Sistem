<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodMenuTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_menu_types', function (Blueprint $table) {
            $table->id();

            $table->foreignId('food_menu')
                ->references('id')
                ->on('food_menus')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('food_type')
                ->references('id')
                ->on('food_types')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->bigInteger('price');

            $table->boolean('visible')->default(true);
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
        Schema::dropIfExists('food_menu_types');
    }
}
