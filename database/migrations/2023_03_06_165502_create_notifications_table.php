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
        Schema::create('notifications', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id');
            $table->string('contenu', 255);
            $table->string('sujet', 255);
            $table->integer('object');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('areasofservice_id')->nullable();
            $table->unsignedBigInteger('objecttype_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
