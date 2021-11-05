<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatronEnsayosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patron_ensayos', function (Blueprint $table) {
            $table->id();
            $table->string('ensayo');
            $table->string('unit_measurement');
            $table->json('rangos')->nullable();
            $table->foreignId('patron_id')->constrained();
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
        Schema::dropIfExists('patron_ensayos');
    }
}
