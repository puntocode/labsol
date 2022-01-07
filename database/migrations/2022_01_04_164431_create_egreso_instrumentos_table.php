<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgresoInstrumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egreso_instrumentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entrada_instrumento_id')->constrained();
            $table->dateTime('fecha')->useCurrent();
            $table->foreignId('entregado_por')->constrained('users');
            $table->string('recibido_por');
            $table->string('identificacion');
            $table->text('observaciones')->nullable();
            $table->string('tipo_retiro');
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
        Schema::dropIfExists('egreso_instrumentos');
    }
}
