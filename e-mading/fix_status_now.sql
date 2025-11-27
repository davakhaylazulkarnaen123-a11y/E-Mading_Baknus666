-- Perbaiki kolom status artikels
ALTER TABLE artikels MODIFY COLUMN status ENUM('draft', 'pending', 'published', 'rejected') DEFAULT 'draft';

-- Verifikasi struktur tabel
DESCRIBE artikels;