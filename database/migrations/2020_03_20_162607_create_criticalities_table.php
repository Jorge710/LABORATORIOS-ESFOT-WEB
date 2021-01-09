<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriticalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criticalities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('equipment_id');
            $table->foreign('equipment_id', 'fk_criticalities_equipment')
                    ->references('id')
                    ->on('equipment')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->integer('frequency');
            $table->integer('operationalImpact');
            $table->integer('flexibility');
            $table->integer('maintenanceCost');
            $table->integer('impactToSafety');
            $table->integer('consequences');
            $table->integer('total');
            $table->unsignedBigInteger('availabilities_id');
            $table->foreign('availabilities_id', 'fk_criticalities_availabilities')
                    ->references('id')
                    ->on('availabilities')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->unsignedBigInteger('maintenance_model_id');
            $table->foreign('maintenance_model_id', 'fk_criticalities_maintenance_model')
                    ->references('id')
                    ->on('maintenance_model')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
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
        Schema::dropIfExists('criticalities');
    }
}
