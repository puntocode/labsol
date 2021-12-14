<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncertidumbresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incertidumbres', function (Blueprint $table) {
            $table->id();
            $table->enum('contribucion', ['EBC', 'PATRON'])->default('EBC');
            $table->enum('tipo', ['A', 'B'])->default('A');
            $table->string('nombre');
            $table->string('distribucion', 50);
            $table->string('formula', 50);
            $table->string('fuente', 50);
            $table->string('divisor', 50);
            $table->string('grados_libertad_for', 50);
            $table->integer('coeficiente');
            $table->integer('contribucion_du');
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
        Schema::dropIfExists('incertidumbres');
    }
}
