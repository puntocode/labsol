<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalibracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibracions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expediente_id')->constrained();
            $table->string('nro_serie')->nullable();
            $table->string('identificacion')->nullable();
            $table->string('unidad_medida')->nullable();
            $table->enum('tipo', ['DIGITAL', 'ANALOGICO'])->nullable();
            $table->float('resolucion')->nullable();
            $table->string('resolucion_medida')->nullable();
            $table->float('intervalo_desde')->nullable();
            $table->float('intervalo_hasta')->nullable();
            $table->string('intervalo_medida')->nullable();
            $table->enum('marca', ['GENERICO', 'OTRO'])->nullable();
            $table->string('especificacion_marca')->nullable();
            $table->string('modelo')->nullable();
            $table->json('patrones')->nullable();
            $table->string('ema')->nullable();
            $table->string('lugar')->nullable();
            $table->string('temperatura_inicial')->nullable();
            $table->string('temperatura_final')->nullable();
            $table->string('humedad_inicial')->nullable();
            $table->string('humedad_final')->nullable();
            $table->string('obs')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('calibracions');
    }
}
