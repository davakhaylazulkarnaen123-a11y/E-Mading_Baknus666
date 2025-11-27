<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE artikels MODIFY COLUMN status ENUM('draft', 'pending', 'published', 'rejected') DEFAULT 'draft'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE artikels MODIFY COLUMN status ENUM('draft', 'published', 'rejected') DEFAULT 'draft'");
    }
};