<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->id('id_notification');
                $table->unsignedBigInteger('id_user');
                $table->string('type');
                $table->string('title');
                $table->text('message');
                $table->json('data')->nullable();
                $table->boolean('is_read')->default(false);
                $table->timestamps();
                
                $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
                $table->index(['id_user', 'is_read']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};