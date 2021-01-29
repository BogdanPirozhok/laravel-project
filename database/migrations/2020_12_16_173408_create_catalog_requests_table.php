<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('email');
            $table->text('phone');
            $table->string('company_name')->nullable();
            $table->text('text')->nullable();
            $table->boolean('data_processing')->default(false);
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
        Schema::dropIfExists('catalog_requests');
    }
}
