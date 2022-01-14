<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valor_historials', function (Blueprint $table) {
            $table->id();
            $table->string('iec_medida', 10)->nullable();
            $table->json('iec_valor')->nullable();
            $table->string('ip_medida', 10)->nullable();
            $table->json('ip_valor')->nullable();
            $table->string('patron', 25)->nullable();
            $table->foreignId('calibracion_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('valor_historials');
    }
}
