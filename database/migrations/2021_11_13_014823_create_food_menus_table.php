<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_menus', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->longText('description');

            $table->foreignId('food_category')
                ->references('id')
                ->on('food_categories')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('food_size')
                ->references('id')
                ->on('food_sizes')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->text('link_image');

            $table->boolean('visible')->default(false);
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
        Schema::dropIfExists('food_menus');
    }
}
