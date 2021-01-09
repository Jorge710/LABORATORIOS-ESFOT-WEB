<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',10)->unique();
            $table->unsignedBigInteger('systems_id');
            $table->foreign('systems_id', 'fk_equipment_systems')
                    ->references('id')->on('systems')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            $table->string('name',190)->nullable();
            $table->text('description')->nullable();
            $table->text('function')->nullable();
            $table->text('recommendation')->nullable();
            $table->text('maintenance')->nullable();
            $table->string('image_equipment',191)->nullable();
            $table->string('datasheet',255)->nullable();
            $table->string('handbook',255)->nullable();
            $table->string('assign_criticality',10)->nullable()->default('DISPONIBLE');
            $table->string('borrowed',2)->nullable()->default('NO');
            $table->string('in_maintenance',2)->nullable()->default('NO');
            $table->unsignedBigInteger('maintenance_frequency_id');
            $table->foreign('maintenance_frequency_id', 'fk_equipment_maintenance_frequency')
                    ->references('id')
                    ->on('maintenance_frequency')
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
        Schema::dropIfExists('equipment');
    }
}
