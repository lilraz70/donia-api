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
        Schema::create('set_countries', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id');
            $table->string('intitule');
            $table->string('code');
            $table->string('prefix');
            $table->string('flag');
            $table->string('statut')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set_countries');
    }
};
