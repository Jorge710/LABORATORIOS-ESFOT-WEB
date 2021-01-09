<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id', 'fk_messages_sender__users')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->unsignedBigInteger('recipient_id');
            $table->foreign('recipient_id', 'fk_messages_recipient__users')
                    ->references('id')
                    ->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            $table->unsignedBigInteger('equipment_id');
            $table->foreign('equipment_id', 'fk_messages_equipment')
                    ->references('id')
                    ->on('equipment')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->text('body');
            $table->text('maintenance_report')->nullable();
            $table->dateTime('maintenance_date')->nullable();
            $table->text('commissioned')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('messages');
    }
}
