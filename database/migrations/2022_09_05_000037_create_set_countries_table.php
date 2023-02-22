<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('set_countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule')->nullable();
            $table->string('code')->unique();
            $table->string('prefix')->unique();
            $table->string('flag')->unique();
            $table->string('statut')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
