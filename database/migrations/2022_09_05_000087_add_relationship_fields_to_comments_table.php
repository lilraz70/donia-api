<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('objecttype_id')->nullable();
            $table->foreign('objecttype_id', 'objecttype_fk_7253541')->references('id')->on('objecttypes');
            $table->unsignedBigInteger('areasofservice_id')->nullable();
            $table->foreign('areasofservice_id', 'areasofservice_fk_7253542')->references('id')->on('areas_of_services');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7253569')->references('id')->on('users');
        });
    }
}