<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrefacturaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefactura_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prefactura_id')->constrained('prefacturas');
            $table->string('sector')->nullable();
            $table->foreignId('expediente_id')->constrained('expedientes');
            $table->float('costo')->default(0);
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
        Schema::dropIfExists('prefactura_detalles');
    }
}
