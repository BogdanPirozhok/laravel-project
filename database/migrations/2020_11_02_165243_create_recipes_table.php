<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->json('name')->nullable();
            $table->string('slug')->unique();
            $table->string('image_url')->nullable();
            $table->json('body');
            $table->json('ingredients')->nullable();
            $table->text('meta_title')->default('{}');
            $table->text('meta_description')->default('{}');
            $table->json('complexity')->default('{}');
            $table->json('cooking_time')->default('{}');
            $table->json('servings')->default('{}');
            $table->boolean('is_published')->default(false);
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
        Schema::dropIfExists('recipes');
    }
}
