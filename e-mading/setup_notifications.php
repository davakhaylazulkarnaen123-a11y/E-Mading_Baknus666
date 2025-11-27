<?php
// Setup tabel notifications
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

use Illuminate\Support\Facades\DB;

try {
    // Hapus tabel jika ada (untuk reset)
    DB::statement("DROP TABLE IF EXISTS notifications");
    
    // Buat tabel notifications
    DB::statement("
        CREATE TABLE notifications (
            id_notification BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            id_user BIGINT UNSIGNED NOT NULL,
            type VARCHAR(255) NOT NULL,
            title VARCHAR(255) NOT NULL,
            message TEXT NOT NULL,
            data JSON NULL,
            is_read BOOLEAN DEFAULT FALSE,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL,
            INDEX idx_user_read (id_user, is_read),
            FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    echo "✅ Tabel notifications berhasil dibuat!\n";
    
    // Test insert notifikasi
    DB::table('notifications')->insert([
        'id_user' => 3, // ID siswa
        'type' => 'test',
        'title' => 'Test Notifikasi',
        'message' => 'Ini adalah test notifikasi sistem.',
        'data' => json_encode(['test' => true]),
        'is_read' => false,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    
    echo "✅ Test notifikasi berhasil dibuat!\n";
    echo "Fitur notifikasi penolakan artikel sekarang sudah aktif.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}