<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',10)->unique();
            $table->unsignedBigInteger('locations_id');
            $table->foreign('locations_id', 'fk_areas_locations')
                    ->references('id')
                    ->on('locations')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            $table->string('name',190);
            $table->text('description')->nullable();
            $table->string('image_areas',191)->nullable();
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
        Schema::dropIfExists('areas');
    }
}
