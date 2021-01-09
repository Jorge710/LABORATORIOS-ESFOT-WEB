<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',10)->unique(); 
            $table->unsignedBigInteger('areas_id');
            $table->foreign('areas_id', 'fk_areas_systems')
                    ->references('id')
                    ->on('areas')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');           
            $table->string('name',190);
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
        Schema::dropIfExists('systems');
    }
}
