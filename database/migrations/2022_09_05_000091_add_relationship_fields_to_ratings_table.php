<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRatingsTable extends Migration
{
    public function up()
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('areasofservices_id')->nullable();
            $table->foreign('areasofservices_id', 'areasofservices_fk_7254319')->references('id')->on('areas_of_services');
            $table->unsignedBigInteger('objecttype_id')->nullable();
            $table->foreign('objecttype_id', 'objecttype_fk_7254320')->references('id')->on('objecttypes');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7254321')->references('id')->on('users');
            $table->unsignedBigInteger('ratingtype_id')->nullable();
            $table->foreign('ratingtype_id', 'ratingtype_fk_7254322')->references('id')->on('rating_types');
        });
    }
}
