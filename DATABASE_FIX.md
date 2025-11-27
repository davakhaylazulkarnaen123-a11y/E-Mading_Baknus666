# Database Fix Instructions

## Problem
Tabel `comments` belum ada di database, menyebabkan error saat mengakses dashboard.

## Solution
Jalankan salah satu cara berikut:

### Cara 1: Via phpMyAdmin
1. Buka phpMyAdmin (http://localhost/phpmyadmin)
2. Pilih database `e_mading`
3. Klik tab "SQL"
4. Copy dan paste isi file `fix_database.sql`
5. Klik "Go"

### Cara 2: Via Command Line (jika PHP tersedia)
```bash
cd c:\laragon\www\e-mading
php artisan migrate
php artisan db:seed
```

### Cara 3: Via MySQL Command Line
```bash
mysql -u root -p e_mading < fix_database.sql
```

## Verification
Setelah menjalankan fix, coba akses dashboard lagi di:
http://127.0.0.1:8000/dashboard

Dashboard seharusnya sudah bisa diakses tanpa error.