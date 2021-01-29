<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('slug')->unique();
            $table->string('image_url')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->json('meta_title')->default(json_encode([]));
            $table->json('meta_description')->default(json_encode([]));

            $table->json('specs')->default(json_encode([]));

            $table->json('material_title')->nullable();
            $table->json('material_sub_title')->nullable();
            $table->json('material_description')->nullable();
            $table->string('material_image_url')->nullable();


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
        Schema::dropIfExists('products');
    }
}
