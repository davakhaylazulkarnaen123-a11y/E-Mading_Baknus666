<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->text('tags')->nullable()->after('status');
            $table->timestamp('scheduled_at')->nullable()->after('tags');
        });
    }

    public function down()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->dropColumn(['tags', 'scheduled_at']);
        });
    }
};