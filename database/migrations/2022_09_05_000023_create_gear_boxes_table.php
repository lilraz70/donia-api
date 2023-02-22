<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGearBoxesTable extends Migration
{
    public function up()
    {
        Schema::create('gear_boxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
