<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->string('certificate')->nullable();
            $table->string('certificate_adress')->nullable();
            $table->string('certificate_ruc')->nullable();
            $table->date('delivery_date')->nullable();
            $table->bigInteger('expediente_estado_id')->unsigned()->default(1);
            $table->string('number')->unique()->nullable();
            $table->enum('priority', ['NORMAL', 'URGENTE'])->default('NORMAL');
            $table->text('obs')->nullable();
            $table->string('service');
            $table->string('type', 5);
            $table->json('tecnicos')->nullable();
            $table->foreign('expediente_estado_id')->references('id')->on('expediente_estados');
            $table->foreignId('entrada_instrumento_id')->constrained()->onDelete('cascade');
            $table->foreignId('instrumento_id')->constrained();
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
        Schema::dropIfExists('expedientes');
    }


    // Tabla de entrada instrumento service
    // public function up()
    // {
    //     Schema::create('entrada_instrumento_services', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('certificate');
    //         $table->string('certificate_adress')->nullable();
    //         $table->string('certificate_ruc')->nullable();
    //         $table->foreignId('entrada_instrumento_id')->constrained()->onDelete('cascade');
    //         $table->foreignId('instrumento_id')->constrained()->onDelete('cascade');
    //         $table->text('obs')->nullable();
    //         $table->enum('priority', ['NORMAL', 'URGENTE'])->default('NORMAL');
    //         $table->string('quantity');
    //         $table->string('service');
    //         $table->timestamps();
    //     });
    // }



}
