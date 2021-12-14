<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorIncertidumbreResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valor_incertidumbre_resultados', function (Blueprint $table) {
            $table->id();
            $table->float('g_libertad_efectivos');
            $table->float('incertidumbre_combinada');
            $table->float('incertidumbre_expandida');
            $table->float('ip');
            $table->float('k');
            $table->float('potencia');
            $table->string('unidad', 10);
            $table->string('patron', 25);
            $table->foreignId('valor_id')->constrained();
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
        Schema::dropIfExists('valor_incertidumbre_resultados');
    }
}
