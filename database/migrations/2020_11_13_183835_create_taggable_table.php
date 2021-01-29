<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaggableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taggable', function (Blueprint $table) {
            $table->integer('tag_id')->unsigned();
            $table->morphs('taggable');
            $table->timestamps();

            // Indexes
            $table->unique(['tag_id', 'taggable_id', 'taggable_type'], 'taggables_ids_type_unique');
            $table->foreign('tag_id')
                ->references('id')
                ->on(config('rinvex.categories.tables.categories'))
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
        Schema::dropIfExists('taggable');
    }
}
