<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParameterUserTypesTable extends Migration
{
    public function up()
    {
        Schema::create('parameter_user_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
