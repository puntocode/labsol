<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradaInstrumentoServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrada_instrumento_services', function (Blueprint $table) {
            $table->id();
            $table->string('certificate');
            $table->string('certificate_adress')->nullable();
            $table->string('certificate_ruc')->nullable();
            $table->foreignId('entrada_instrumento_id')->constrained()->onDelete('cascade');
            $table->foreignId('instrumento_id')->constrained()->onDelete('cascade');
            $table->text('obs')->nullable();
            $table->enum('priority', ['NORMAL', 'URGENTE'])->default('NORMAL');
            $table->string('quantity');
            $table->string('service');
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
        Schema::dropIfExists('entrada_instrumento_services');
    }
}
