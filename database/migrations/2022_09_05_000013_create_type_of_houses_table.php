<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeOfHousesTable extends Migration
{
    public function up()
    {
        Schema::create('type_of_houses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
