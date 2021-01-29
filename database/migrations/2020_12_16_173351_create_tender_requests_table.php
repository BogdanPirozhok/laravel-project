<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('email');
            $table->text('phone');
            $table->integer('tender_id');
            $table->text('company_name')->nullable();
            $table->text('file_path')->nullable();
            $table->text('file_name')->nullable();
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
        Schema::dropIfExists('tender_requests');
    }
}
