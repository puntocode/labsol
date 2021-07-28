<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatronProcedimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patron_procedimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patron_id')->constrained()->onDelete('cascade');
            $table->foreignId('procedimiento_id')->constrained()->onDelete('cascade');
            $table->unique(['patron_id', 'procedimiento_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patron_procedimiento');
    }
}
