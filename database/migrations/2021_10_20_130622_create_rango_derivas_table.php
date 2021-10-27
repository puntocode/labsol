<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRangoDerivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rango_derivas', function (Blueprint $table) {
            $table->id();
            $table->json('ip')->nullable();
            $table->json('u')->nullable();
            $table->float('k')->nullable();
            $table->json('uc')->nullable();
            $table->json('e_actual')->nullable();
            $table->json('e_anterior')->nullable();
            $table->json('deriva')->nullable();
            $table->foreignId('ide_rango_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('rango_derivas');
    }
}
