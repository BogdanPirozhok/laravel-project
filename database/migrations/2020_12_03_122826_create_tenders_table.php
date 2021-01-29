<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('unit');
            $table->string('volume');
            $table->text('description')->nullable();
            $table->boolean('is_published')->default(false);
            $table->string('deadline')->nullable();
            $table->text('job_description_file_path')->nullable();
            $table->text('job_description_file_name')->nullable();
            $table->text('job_work_file_path')->nullable();
            $table->text('job_work_file_name')->nullable();
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
        Schema::dropIfExists('tenders');
    }
}
