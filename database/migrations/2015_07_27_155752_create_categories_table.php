<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('name')->unique();
            $table->string('table_name')->unique();
            $table->text('description');
            $table->string('image');
            // Тип категории:
            // 0 - продукт
            // 1 - рецепт
            $table->integer('type');
            $table->boolean('final')->default(1);
            $table->integer('num_columns')->default(0);
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
        Schema::drop('categories');
    }
}
