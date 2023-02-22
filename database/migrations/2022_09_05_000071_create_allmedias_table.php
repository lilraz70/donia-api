<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllmediasTable extends Migration
{
    public function up()
    {
        Schema::create('allmedias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('etiquettes');
            $table->longText('description')->nullable();
            $table->string('objet');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
