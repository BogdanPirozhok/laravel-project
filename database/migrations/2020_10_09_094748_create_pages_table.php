<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->json('body')->default(json_encode([]));
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('template_id');
            $table->foreign('template_id')->references('id')->on('templates');
            $table->boolean('is_published')->default(false);
            $table->json('custom_meta_tags')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->json('settings')->default(json_encode([]));
            $table->boolean('essential')->default(false);
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
        Schema::dropIfExists('pages');
    }
}
