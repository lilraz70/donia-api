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
        Schema::create('accept_cgus', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id')->primary();
            $table->string('deviceinfo', 255);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_id')->nullable()->index('user_fk_7255198');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accept_cgus');
    }
};
