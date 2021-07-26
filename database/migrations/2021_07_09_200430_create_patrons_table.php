<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatronsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrons', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->string('description');
            $table->json('rank')->nullable();
            $table->json('precision')->nullable();
            $table->string('brand', 50)->nullable();
            $table->string('calibration_period')->nullable();
            $table->string('certificate_no')->nullable();
            $table->json('error_max')->nullable();
            $table->date('last_calibration')->nullable();
            $table->date('next_calibration')->nullable();
            $table->foreignId('condition_id')->constrained();
            $table->foreignId('magnitude_id')->constrained();
            $table->foreignId('alert_calibration_id')->constrained();
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
        Schema::dropIfExists('patrons');
    }
}
