# Perbaikan Error 403 Forbidden pada Gambar Artikel

## Masalah
Error 403 Forbidden saat mengakses gambar artikel yang diupload.

## Penyebab
File gambar tersimpan di lokasi yang salah:
- ❌ Tersimpan di: `storage/app/private/public/artikels/`
- ✅ Seharusnya di: `storage/app/public/artikels/`

Masalah terjadi karena kode menggunakan:
```php
$file->storeAs('public/artikels', $fotoName);
```

Ini menyimpan ke disk 'local' (default) yang root-nya adalah `storage/app/private/`, sehingga path lengkapnya menjadi `storage/app/private/public/artikels/`.

## Solusi

### 1. Perbaikan Kode di ArtikelController
```php
// Sebelum
$file->storeAs('public/artikels', $fotoName);

// Sesudah
$file->storeAs('artikels', $fotoName, 'public');
```

### 2. Memindahkan File yang Sudah Ada
Semua file gambar yang sudah diupload dipindahkan ke lokasi yang benar menggunakan:
```bash
xcopy storage\app\private\public\artikels\*.* storage\app\public\artikels\ /Y
```

Total 32 file berhasil dipindahkan.

## File yang Diperbaiki
- ✅ `app/Http/Controllers/ArtikelController.php`

## Hasil
- ✅ Gambar artikel sekarang dapat diakses tanpa error 403
- ✅ Upload gambar baru akan tersimpan di lokasi yang benar
- ✅ Symbolic link `public/storage` dapat mengakses file dengan benar

## Testing
Cek gambar dapat diakses di:
- URL: `http://localhost:8000/storage/artikels/1763622133_691ebcf5903ed.png`
- Status: ✅ 200 OK (sebelumnya 403 Forbidden)
