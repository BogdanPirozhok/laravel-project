<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
//            $table->uuid('uuid');
            $table->integer('type');
            $table->text('address');
            $table->text('name');
            $table->text('info');
            $table->double('longitude');
            $table->double('latitude');
            $table->string('store_uid')->nullable();
            $table->foreign('store_uid')
                ->references('store_uid')
                ->on('store_networks')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('points');
    }
}
