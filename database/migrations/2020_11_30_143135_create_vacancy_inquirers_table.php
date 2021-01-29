<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacancyInquirersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_inquirers', function (Blueprint $table) {
            $table->id();
            $table->text('email');
            $table->string('name');
            $table->string('phone');
            $table->text('application_text')->nullable();
            $table->text('resume_file_path')->nullable();
            $table->text('resume_file_name')->nullable();
            $table->integer('vacancy_id')->nullable();
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
        Schema::dropIfExists('vacancy_inquirers');
    }
}
