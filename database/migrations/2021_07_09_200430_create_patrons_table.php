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
            $table->string('brand', 100)->nullable();
            $table->json('rank')->nullable();
            $table->json('precision')->nullable();
            $table->enum('calibration', ['INTERNA', 'EXTERNA', 'INT/EXT', 'N/A'])->default('N/A');
            $table->integer('calibration_period')->nullable();
            $table->string('certificate_no')->nullable();
            $table->json('error_max')->nullable();
            $table->date('last_calibration')->nullable();
            $table->date('next_calibration')->nullable();
            $table->string('ubication')->nullable();
            $table->string('serie_number')->nullable();
            $table->enum('type', ['DIGITAL', 'ANALOGICO'])->default('DIGITAL');
            $table->string('type_description')->nullable();
            $table->string('model', 100)->nullable();
            $table->string('uncertainty')->nullable();
            $table->string('tolerance')->nullable();
            $table->unsignedBigInteger('procedimiento_id')->default(0);
            $table->foreignId('condition_id')->constrained();
            $table->foreignId('magnitude_id')->constrained();
            $table->foreignId('alert_calibration_id')->constrained();
            $table->unsignedBigInteger('formulario_id')->default(1);
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
