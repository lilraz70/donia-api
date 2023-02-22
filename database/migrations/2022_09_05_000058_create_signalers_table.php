<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignalersTable extends Migration
{
    public function up()
    {
        Schema::create('signalers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('experience_utilisateur');
            $table->string('comment');
            $table->integer('objet');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
