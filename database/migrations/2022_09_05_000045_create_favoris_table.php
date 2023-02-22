<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavorisTable extends Migration
{
    public function up()
    {
        Schema::create('favoris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('object');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
