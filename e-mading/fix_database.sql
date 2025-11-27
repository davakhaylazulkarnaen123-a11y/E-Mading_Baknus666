-- Drop existing comments table if exists
DROP TABLE IF EXISTS comments;

-- Create comments table with correct structure
CREATE TABLE comments (
    id_comment BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_artikel BIGINT UNSIGNED NOT NULL,
    id_user BIGINT UNSIGNED NOT NULL,
    isi_komentar TEXT NOT NULL,
    is_approved TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (id_artikel) REFERENCES artikels(id_artikel) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);

-- Create reports table if not exists
CREATE TABLE IF NOT EXISTS reports (
    id_report BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT NULL,
    tanggal_mulai DATE NOT NULL,
    tanggal_selesai DATE NOT NULL,
    jenis ENUM('artikel', 'komentar', 'user', 'aktivitas') NOT NULL,
    data JSON NULL,
    id_user BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);