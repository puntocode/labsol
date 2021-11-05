<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedimientos', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->string('name');
            $table->integer('revision')->default(0);
            $table->date('validity')->nullable();
            $table->string('valve', 10)->nullable();
            $table->boolean('accredited_scope')->default(0);
            $table->unsignedBigInteger('equipo_ambiental_id')->default(1);
            $table->string('pdf')->nullable();
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
        Schema::dropIfExists('procedimientos');
    }
}
