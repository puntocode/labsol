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
            $table->foreignId('entrada_instrumento_id')->constrained()->onDelete('cascade');
            $table->foreignId('instrumento_id')->constrained()->onDelete('cascade');
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
