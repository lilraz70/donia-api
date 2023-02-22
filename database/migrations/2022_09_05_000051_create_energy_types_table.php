<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnergyTypesTable extends Migration
{
    public function up()
    {
        Schema::create('energy_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
