<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('likes')) {
            Schema::create('likes', function (Blueprint $table) {
                $table->id('id_like');
                $table->unsignedBigInteger('id_artikel');
                $table->unsignedBigInteger('id_user');
                $table->foreign('id_artikel')->references('id_artikel')->on('artikels')->onDelete('cascade');
                $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
};