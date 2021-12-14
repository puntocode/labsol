<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valor_resultados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('valor_id')->constrained();
            $table->float('desv_iec');
            $table->float('desv_ip');
            $table->float('error_iec');
            $table->float('error_ip');
            $table->float('iec');
            $table->float('ip');
            $table->float('ip_corregido');
            $table->float('uk');
            $table->string('unidad');
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
        Schema::dropIfExists('valor_resultados');
    }
}
