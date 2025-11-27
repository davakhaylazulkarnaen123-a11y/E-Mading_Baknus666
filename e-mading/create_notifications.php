<?php
// Script untuk membuat tabel notifications
// Jalankan dengan: php create_notifications.php

// Load Laravel
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

use Illuminate\Support\Facades\DB;

try {
    // Cek apakah tabel sudah ada
    $exists = DB::select("SHOW TABLES LIKE 'notifications'");
    
    if (count($exists) > 0) {
        echo "Tabel notifications sudah ada.\n";
        exit;
    }
    
    // Buat tabel notifications
    DB::statement("
        CREATE TABLE `notifications` (
          `id_notification` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
          `id_user` bigint(20) UNSIGNED NOT NULL,
          `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
          `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
          `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
    echo "Sekarang fitur notifikasi penolakan artikel sudah bisa digunakan.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Silakan jalankan query SQL manual di phpMyAdmin.\n";
}