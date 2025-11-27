# 📸 Cara Upload Gambar Artikel - E-Mading

## ✅ Fitur Upload Gambar yang Tersedia

### 1. **Pilih dari Folder (Cara Standar)**
Cara paling umum untuk upload gambar:

**Langkah-langkah:**
1. Klik area upload atau tombol "Pilih Gambar dari Folder"
2. Browser akan membuka dialog file picker
3. Navigasi ke folder yang berisi gambar Anda
4. Pilih file gambar (JPG, PNG, GIF, WEBP)
5. Klik "Open" atau "Pilih"
6. ✅ **Gambar langsung terlihat di preview!**

### 2. **Drag & Drop**
Upload dengan cara drag and drop:

**Langkah-langkah:**
1. Buka Windows Explorer / File Manager
2. Navigasi ke folder yang berisi gambar
3. Drag (seret) file gambar
4. Drop (lepas) di area upload yang ditandai
5. ✅ **Gambar langsung terlihat di preview!**

### 3. **Paste dari Clipboard (BARU!)**
Upload gambar dari clipboard (screenshot, copy image):

**Langkah-langkah:**
1. Copy gambar dari aplikasi lain (Ctrl+C)
   - Screenshot (Win+Shift+S atau PrtScn)
   - Copy gambar dari browser
   - Copy dari aplikasi editing
2. Klik di halaman form artikel
3. Paste (Ctrl+V)
4. ✅ **Gambar langsung terlihat di preview!**

## 🎯 Preview Gambar Real-Time

### Preview Saat Upload
Setelah memilih/upload gambar:
- ✅ Gambar langsung muncul di area upload
- ✅ Ukuran file divalidasi (max 5MB)
- ✅ Format file divalidasi (JPG, PNG, GIF, WEBP)
- ✅ Tombol "Hapus" untuk mengganti gambar

### Preview di Modal Pratinjau
Saat klik tombol "Pratinjau":
- ✅ Gambar cover ditampilkan di atas artikel
- ✅ Judul artikel
- ✅ Isi artikel
- ✅ Tampilan seperti artikel yang sudah publish

### Preview di Sidebar (create-advanced)
- ✅ Gambar muncul di preview sidebar
- ✅ Update otomatis saat gambar diupload
- ✅ Refresh preview untuk update

## 📋 Spesifikasi Gambar

### Format yang Didukung
- ✅ JPG / JPEG
- ✅ PNG
- ✅ GIF
- ✅ WEBP

### Ukuran File
- **Maksimal:** 5MB
- **Rekomendasi:** 500KB - 2MB untuk performa optimal

### Resolusi Rekomendasi
- **Minimal:** 800x600 px
- **Optimal:** 1200x800 px
- **Maksimal:** 4000x3000 px

## 🔄 Alur Upload Gambar

```
1. User pilih gambar dari folder
   ↓
2. Validasi format & ukuran
   ↓
3. Preview gambar muncul
   ↓
4. User isi form artikel
   ↓
5. User klik "Simpan"
   ↓
6. Gambar diupload ke server
   ↓
7. Artikel tersimpan dengan status:
   - Siswa → "pending" (menunggu verifikasi)
   - Guru/Admin → "published" (langsung publish)
   ↓
8. Gambar terlihat di artikel
```

## 🎨 Status Artikel & Gambar

### Untuk Siswa
- Status artikel: **"pending"** (menunggu verifikasi)
- Gambar: ✅ Tersimpan dan terlihat di preview
- Setelah disetujui: ✅ Artikel & gambar publish

### Untuk Guru/Admin
- Status artikel: **"published"** (langsung publish)
- Gambar: ✅ Langsung terlihat publik

## ⚠️ Troubleshooting

### Gambar tidak muncul setelah upload?
**Solusi:**
1. Cek ukuran file (max 5MB)
2. Cek format file (harus JPG/PNG/GIF/WEBP)
3. Refresh halaman
4. Coba upload ulang

### Error 403 Forbidden?
**Solusi:**
- Sudah diperbaiki! File sekarang tersimpan di lokasi yang benar
- Jika masih error, jalankan: `php artisan storage:link`

### Gambar terlalu besar?
**Solusi:**
1. Compress gambar menggunakan:
   - TinyPNG.com
   - Compressor.io
   - Paint (Save As → pilih quality)
2. Resize gambar ke ukuran optimal (1200x800)

### Preview tidak muncul?
**Solusi:**
1. Pastikan JavaScript aktif di browser
2. Clear cache browser (Ctrl+Shift+Del)
3. Coba browser lain (Chrome, Firefox, Edge)

## 💡 Tips Upload Gambar

### Untuk Performa Terbaik
1. ✅ Compress gambar sebelum upload
2. ✅ Gunakan format WEBP untuk ukuran lebih kecil
3. ✅ Resize gambar ke ukuran optimal
4. ✅ Hindari upload gambar > 2MB

### Untuk Kualitas Terbaik
1. ✅ Gunakan gambar dengan resolusi tinggi
2. ✅ Pastikan gambar tidak blur
3. ✅ Gunakan gambar yang relevan dengan artikel
4. ✅ Hindari gambar dengan watermark besar

### Untuk Keamanan
1. ✅ Jangan upload gambar yang mengandung informasi pribadi
2. ✅ Pastikan gambar tidak melanggar hak cipta
3. ✅ Hindari gambar yang tidak pantas

## 🚀 Fitur Tambahan

### Auto-Save
- Form artikel auto-save setiap 3 detik
- Gambar tersimpan di browser sampai submit

### Validasi Real-Time
- Ukuran file dicek sebelum upload
- Format file divalidasi otomatis
- Pesan error yang jelas

### Multiple Upload Methods
- File picker (standar)
- Drag & drop
- Paste dari clipboard

## 📞 Bantuan

Jika masih ada masalah:
1. Hubungi admin sekolah
2. Buat issue di GitHub repository
3. Email: support@e-mading.sch.id

---

**Update Terakhir:** 2025-01-20
**Status:** ✅ Semua fitur berfungsi normal
