<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmcRangosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cmc_rangos', function (Blueprint $table) {
            $table->id();
            $table->float('rango_de');
            $table->float('rango_a');
            $table->float('cmc');
            $table->foreignId('cmc_id')->constrained('cmcs')->onDelete('cascade');
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
        Schema::dropIfExists('cmc_rangos');
    }
}
