<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valor_certificados', function (Blueprint $table) {
            $table->id();
            $table->float('e');
            $table->float('iec');
            $table->float('ip');
            $table->float('k');
            $table->float('u');
            $table->string('unidad', 10);
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
        Schema::dropIfExists('valor_certificados');
    }
}
