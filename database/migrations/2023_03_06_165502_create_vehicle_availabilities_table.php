<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_availabilities', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id');
            $table->date('jour_debut');
            $table->time('heure_debut')->nullable();
            $table->date('jour_fin')->nullable();
            $table->time('heure_fin')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('sellrentcar_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_availabilities');
    }
};
