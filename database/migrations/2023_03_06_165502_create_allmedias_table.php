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
        Schema::create('allmedias', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id')->primary();
            $table->string('etiquettes', 255);
            $table->longText('description')->nullable();
            $table->string('objet', 255);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('objecttype_id')->nullable()->index('objecttype_fk_7255947');
            $table->unsignedBigInteger('typeofmedia_id')->nullable()->index('typeofmedia_fk_7255948');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allmedias');
    }
};
