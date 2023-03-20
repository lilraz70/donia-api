<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosting_services', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('lodging_id')->nullable();
            $table->unsignedBigInteger('servicesinclus_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosting_services');
    }
};
