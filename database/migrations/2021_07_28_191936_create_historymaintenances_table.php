<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorymaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historymaintenances', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('done');
            $table->string('reason')->nullable();
            $table->date('maintenance_date')->nullable();
            $table->date('next_maintenance')->nullable();
            $table->text('obs')->nullable();
            $table->string('historymaintenance_type');
            $table->unsignedBigInteger('historymaintenance_id');
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
        Schema::dropIfExists('historymaintenances');
    }
}
