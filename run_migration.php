<?php

// Bootstrap Laravel
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    // Check if table exists
    if (!Schema::hasTable('notifications')) {
        DB::statement("
            CREATE TABLE `notifications` (
              `id_notification` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
              `id_user` bigint(20) UNSIGNED NOT NULL,
              `type` varchar(255) NOT NULL,
              `title` varchar(255) NOT NULL,
              `message` text NOT NULL,
              `data` json DEFAULT NULL,
              `is_read` tinyint(1) NOT NULL DEFAULT 0,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id_notification`),
              KEY `notifications_id_user_is_read_index` (`id_user`,`is_read`),
              CONSTRAINT `notifications_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        echo "✅ Tabel notifications berhasil dibuat!\n";
    } else {
        echo "ℹ️ Tabel notifications sudah ada.\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}