<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name')->nullable();
            $table->integer('taxonomy');
            $table->text('item_url')->nullable();
            $table->integer('item_menu_id')->nullable();
            $table->foreign('item_menu_id')->references('id')->on('menus')->onDelete('cascade');;
            $table->json('item_caption')->nullable();
            $table->json('item_description')->nullable();
            $table->text('item_icon')->nullable();
            $table->string('item_target')->nullable();
            $table->integer('item_parent')->nullable();
            $table->integer('order')->default(0);
            $table->string('menu_position')->nullable();
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
        Schema::dropIfExists('menus');
    }
}
