<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListOfCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('list_of_countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule')->unique();
            $table->string('code')->unique();
            $table->string('prefix')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
