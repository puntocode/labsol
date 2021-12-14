<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncertidumbreProcedimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incertidumbre_procedimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incertidumbre_id')->constrained();
            $table->foreignId('procedimiento_id')->constrained();
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
        Schema::dropIfExists('incertidumbre_procedimiento');
    }
}
