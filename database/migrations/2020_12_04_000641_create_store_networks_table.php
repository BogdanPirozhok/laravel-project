<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_networks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('logo_image_path')->nullable();
            $table->text('logo_image_name')->nullable();
            $table->text('mark_image_path')->nullable();
            $table->text('mark_image_name')->nullable();
            $table->text('external_url')->nullable();
            $table->string('store_uid')->nullable()->unique();

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
        Schema::dropIfExists('store_networks');
    }
}
