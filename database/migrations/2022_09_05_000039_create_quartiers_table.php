<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuartiersTable extends Migration
{
    public function up()
    {
        Schema::create('quartiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
