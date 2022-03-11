<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calibracion_id')->constrained()->onDelete('cascade');
            $table->string('iec_medida', 10)->nullable();
            $table->string('ip_medida', 10)->nullable();
            $table->json('iec_valor');
            $table->json('ip_valor');
            $table->string('patron', 25);
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
        Schema::dropIfExists('valors');
    }
}
