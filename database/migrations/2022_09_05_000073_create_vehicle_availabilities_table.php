<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleAvailabilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicle_availabilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('jour_debut');
            $table->time('heure_debut')->nullable();
            $table->date('jour_fin')->nullable();
            $table->time('heure_fin')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
