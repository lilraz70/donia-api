<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovesTable extends Migration
{
    public function up()
    {
        Schema::create('approves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comment');
            $table->integer('objet');
            $table->string('resultat');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
