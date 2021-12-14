<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentoProcedimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrumento_procedimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instrumento_id')->constrained();
            $table->foreignId('procedimiento_id')->constrained();
            $table->unique(['instrumento_id', 'procedimiento_id']);
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
        Schema::dropIfExists('instrumento_procedimiento');
    }
}
