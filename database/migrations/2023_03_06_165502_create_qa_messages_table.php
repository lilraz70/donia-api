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
        Schema::create('qa_messages', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('topic_id');
            $table->unsignedBigInteger('sender_id');
            $table->timestamp('read_at')->nullable();
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qa_messages');
    }
};
