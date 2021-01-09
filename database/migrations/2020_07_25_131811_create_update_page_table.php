<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdatePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_page', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->string('sliderImage1',191)->nullable();
            $table->string('sliderImage2',191)->nullable();
            $table->string('sliderImage3',191)->nullable();
            $table->string('image1',191)->nullable();
            $table->string('image2',191)->nullable();
            $table->string('image3',191)->nullable();
            $table->string('image4',191)->nullable();
            $table->string('image5',191)->nullable();
            $table->string('image6',191)->nullable();
            $table->string('email',191)->unique();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('update_page');
    }
}
