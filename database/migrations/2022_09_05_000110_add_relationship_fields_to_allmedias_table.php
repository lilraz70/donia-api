<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAllmediasTable extends Migration
{
    public function up()
    {
        Schema::table('allmedias', function (Blueprint $table) {
            $table->unsignedBigInteger('objecttype_id')->nullable();
            $table->foreign('objecttype_id', 'objecttype_fk_7255947')->references('id')->on('objecttypes');
            $table->unsignedBigInteger('typeofmedia_id')->nullable();
            $table->foreign('typeofmedia_id', 'typeofmedia_fk_7255948')->references('id')->on('type_of_media');
        });
    }
}
