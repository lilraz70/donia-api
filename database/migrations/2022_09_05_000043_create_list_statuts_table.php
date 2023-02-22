<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListStatutsTable extends Migration
{
    public function up()
    {
        Schema::create('list_statuts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
