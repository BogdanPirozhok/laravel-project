<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimilarRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('similar_recipes', function (Blueprint $table) {
            $table->integer('recipe_id')->unsigned();
            $table->morphs('similar_product');
            $table->timestamps();

            $table->unique(['recipe_id', 'similar_product_id', 'similar_product_type'], 'similar_product_recipe_ids_type_unique');
            $table->foreign('similar_product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('recipe_id')
                ->references('id')
                ->on('recipes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('similar_recipes');
    }
}
