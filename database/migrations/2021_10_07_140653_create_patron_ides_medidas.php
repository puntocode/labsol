<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatronIdesMedidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patron_ides_medidas', function (Blueprint $table) {
            $table->id();
            $table->string('prefijo', 20);
            $table->string('simbolo', 10);
            $table->string('factor', 10);
            $table->string('equivalente')->nullable();
            $table->enum('tipo', ['MULTIPLOS', 'SUBMULTIPLOS'])->default('MULTIPLOS');
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
        Schema::dropIfExists('patron_ides_medidas');
    }
}
