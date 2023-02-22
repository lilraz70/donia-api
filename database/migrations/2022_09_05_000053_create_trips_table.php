<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule')->unique();
            $table->string('lieu_depart')->unique();
            $table->string('heure_depart');
            $table->string('lieu_arrive');
            $table->string('heure_arrive')->nullable();
            $table->string('cout')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
