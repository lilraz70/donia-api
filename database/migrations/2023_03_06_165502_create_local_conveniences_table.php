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
        Schema::create('local_conveniences', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('local_id')->nullable();
            $table->unsignedBigInteger('conveniencetype_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_conveniences');
    }
};
