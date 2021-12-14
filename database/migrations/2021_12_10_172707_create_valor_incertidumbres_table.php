<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorIncertidumbresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valor_incertidumbres', function (Blueprint $table) {
            $table->id();
            $table->float('u');
            $table->float('u_du');
            $table->string('g_libertad');
            $table->string('potencia');
            $table->foreignId('incertidumbre_id')->constrained();
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
        Schema::dropIfExists('valor_incertidumbres');
    }
}
