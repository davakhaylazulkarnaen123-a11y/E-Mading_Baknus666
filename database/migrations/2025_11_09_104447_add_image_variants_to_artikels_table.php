<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->string('foto_thumbnail')->nullable()->after('foto');
            $table->string('foto_medium')->nullable()->after('foto_thumbnail');
            $table->string('foto_webp')->nullable()->after('foto_medium');
        });
    }

    public function down(): void
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->dropColumn(['foto_thumbnail', 'foto_medium', 'foto_webp']);
        });
    }
};