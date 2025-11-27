-- SQL untuk menambahkan kolom rejection reason ke tabel artikels
ALTER TABLE `artikels` 
ADD COLUMN `rejection_reason` TEXT NULL AFTER `status`,
ADD COLUMN `reviewed_at` TIMESTAMP NULL AFTER `rejection_reason`,
ADD COLUMN `reviewed_by` BIGINT UNSIGNED NULL AFTER `reviewed_at`,
ADD FOREIGN KEY (`reviewed_by`) REFERENCES `users`(`id_user`) ON DELETE SET NULL;