<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_feedback', function (Blueprint $table) {
            $table->id();
            $table->date('purchase_date')->nullable();
            $table->string('purchase_place_name')->nullable();
            $table->string('purchase_place_address')->nullable();
            $table->text('barcode_file_path')->nullable();
            $table->text('barcode_file_name')->nullable();
            $table->date('purchase_product_date')->nullable();
            $table->text('purchase_product_description')->nullable();
            $table->text('wishes')->nullable();
            $table->boolean('contact_me')->default(false);
            $table->text('contact_name')->nullable();
            $table->text('contact_attribute')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
Ч     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quality_feedback');
    }
}
