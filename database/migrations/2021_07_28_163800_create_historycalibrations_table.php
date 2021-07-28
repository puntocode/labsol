<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorycalibrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historycalibrations', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_no');
            $table->string('done');
            $table->date('calibration')->nullable();
            $table->date('next_calibration')->nullable();
            $table->text('obs')->nullable();
            $table->string('historycalibration_type');
            $table->unsignedBigInteger('historycalibration_id');
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
        Schema::dropIfExists('historycalibrations');
    }
}
