<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeRangosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ide_rangos', function (Blueprint $table) {
            $table->id();
            $table->integer('rango');
            $table->string('rango_medida');
            $table->string('resolucion');
            $table->string('resolucion_medida');
            $table->foreignId('patron_ide_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('ide_rangos');
    }
}
