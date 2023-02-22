<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeedLandsTable extends Migration
{
    public function up()
    {
        Schema::create('need_lands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('superficie', 15, 2);
            $table->longText('localisation');
            $table->string('geolocalisation')->nullable();
            $table->integer('prix_vente')->nullable();
            $table->integer('prix_location')->nullable();
            $table->longText('condition_location')->nullable();
            $table->longText('condition_vente')->nullable();
            $table->longText('description')->nullable();
            $table->string('libelle')->unique();
            $table->string('satisfait')->nullable();
            $table->date('date_satisfait')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
