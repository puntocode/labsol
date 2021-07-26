<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->string('description');
            $table->string('brand', 50)->nullable();
            $table->json('rank')->nullable();
            $table->string('resolution')->nullable();
            $table->string('error_max')->nullable();
            $table->string('calibration_period')->nullable();
            $table->string('certificate_no')->nullable();
            $table->date('last_calibration')->nullable();
            $table->date('next_calibration')->nullable();
            $table->foreignId('alert_calibration_id')->constrained();
            $table->foreignId('condition_id')->constrained();
            $table->foreignId('magnitude_id')->constrained();
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
        Schema::dropIfExists('equipos');
    }
}
