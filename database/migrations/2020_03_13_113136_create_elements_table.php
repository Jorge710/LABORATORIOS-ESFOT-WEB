<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('equipment_id');
            $table->foreign('equipment_id', 'fk_elements_equipment')
                    ->references('id')
                    ->on('equipment')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            $table->string('name',190);
            $table->integer('number_of');
            $table->text('description');
            $table->text('function');
            $table->string('image_elements',191)->nullable();
            $table->text('faultDescription');
            $table->unsignedBigInteger('typefailures_id');
            $table->foreign('typefailures_id', 'fk_elements_typefailures')
                    ->references('id')
                    ->on('type_failures')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->text('failMode');
            $table->unsignedBigInteger('classifications_id');
            $table->foreign('classifications_id', 'fk_elements_classifications')
                    ->references('id')
                    ->on('classifications')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->text('maintenanceActivity');
            $table->text('maintenanceTask');
            $table->text('improvements')->nullable();
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
        Schema::dropIfExists('elements');
    }
}
