<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserservicesTable extends Migration
{
    public function up()
    {
        Schema::table('userservices', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7255209')->references('id')->on('users');
            $table->unsignedBigInteger('areasofservice_id')->nullable();
            $table->foreign('areasofservice_id', 'areasofservice_fk_7255210')->references('id')->on('areas_of_services');
        });
    }
}
