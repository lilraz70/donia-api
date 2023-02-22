<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSignalersTable extends Migration
{
    public function up()
    {
        Schema::table('signalers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7255343')->references('id')->on('users');
            $table->unsignedBigInteger('objecttype_id')->nullable();
            $table->foreign('objecttype_id', 'objecttype_fk_7255344')->references('id')->on('objecttypes');
            $table->unsignedBigInteger('reason_id')->nullable();
            $table->foreign('reason_id', 'reason_fk_7255345')->references('id')->on('reasons');
        });
    }
}
