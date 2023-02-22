<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserparamsTable extends Migration
{
    public function up()
    {
        Schema::table('userparams', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7255321')->references('id')->on('users');
            $table->unsignedBigInteger('parameterusertype_id')->nullable();
            $table->foreign('parameterusertype_id', 'parameterusertype_fk_7255322')->references('id')->on('parameter_user_types');
        });
    }
}
