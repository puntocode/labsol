<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cmcs', function (Blueprint $table) {
            $table->id();
            $table->string('unidad_medida', 10);
            $table->foreignId('procedimiento_id')->constrained('procedimientos')->onDelete('cascade');
            $table->foreignId('patron_id')->constrained('patrons')->onDelete('cascade');
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
        Schema::dropIfExists('cmcs');
    }
}
