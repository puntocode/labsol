<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradaInstrumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrada_instrumentos', function (Blueprint $table) {
            $table->id();
            $table->string('delivered')->nullable();
            // $table->string('certificate');
            // $table->string('certificate_address')->nullable();
            // $table->string('certificate_ruc')->nullable();
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->json('contact')->nullable();
            $table->integer('identification')->nullable();
            $table->foreignId('instrumento_id')->constrained()->onDelete('cascade');
            $table->text('obs')->nullable();
            $table->enum('priority', ['NORMAL', 'URGENTE'])->default('NORMAL');
            $table->foreignId('procedimiento_id')->constrained()->onDelete('cascade');
            $table->string('quantity');
            $table->enum('type', ['LS', 'LSI'])->default('LS');
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('entrada_instrumentos');
    }
}
