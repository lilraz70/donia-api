<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToNotificationsTable extends Migration
{
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('areasofservice_id')->nullable();
            $table->foreign('areasofservice_id', 'areasofservice_fk_7253606')->references('id')->on('areas_of_services');
            $table->unsignedBigInteger('objecttype_id')->nullable();
            $table->foreign('objecttype_id', 'objecttype_fk_7253607')->references('id')->on('objecttypes');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7253608')->references('id')->on('users');
        });
    }
}
