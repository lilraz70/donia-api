<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelOfVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('model_of_vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
