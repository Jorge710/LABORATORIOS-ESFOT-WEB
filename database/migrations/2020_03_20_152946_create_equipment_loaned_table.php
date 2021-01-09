<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentLoanedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_loaned', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lent_by',191)->nullable();
            $table->unsignedBigInteger('equipment_id');
            $table->foreign('equipment_id', 'fk_equipment_loaned_equipment')
                    ->references('id')
                    ->on('equipment')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->dateTime('loan_date');
            $table->string('name',191);
            $table->string('faculty',191);
            $table->string('career',191);
            $table->string('email',191)->unique();
            $table->text('loan_observation')->nullable();
            $table->text('observation_return')->nullable();
            $table->dateTime('return_date')->nullable();
            $table->string('received_by',191)->nullable();
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
        Schema::dropIfExists('equipment_loaned');
    }
}
