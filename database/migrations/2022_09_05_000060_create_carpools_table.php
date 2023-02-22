<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarpoolsTable extends Migration
{
    public function up()
    {
        Schema::create('carpools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('paiement');
            $table->string('preuve_paiement')->nullable();
            $table->string('mention_arrive')->nullable();
            $table->string('mention_arv_heure')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
