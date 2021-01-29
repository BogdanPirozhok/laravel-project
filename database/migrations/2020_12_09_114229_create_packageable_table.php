<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packageable', function (Blueprint $table) {
            $table->integer('package_id')->unsigned();
            $table->morphs('packageable');
            $table->timestamps();

            // Indexes
            $table->unique(['package_id', 'packageable_id', 'packageable_type'], 'packageables_ids_type_unique');
            $table->foreign('package_id')
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
        Schema::dropIfExists('packageable');
    }
}
