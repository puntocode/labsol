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
            $table->foreignId('entrada_instrumento_service_id')->constrained();
            $table->bigInteger('expediente_estado_id')->unsigned()->default(1);
            $table->date('delivery_date')->nullable();
            $table->string('number')->unique()->nullable();
            $table->string('type', 5);
            $table->json('tecnicos')->nullable();
            $table->foreign('expediente_estado_id')->references('id')->on('expediente_estados');
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
}
