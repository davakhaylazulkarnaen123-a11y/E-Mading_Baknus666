# 📰 E-Mading Digital - Platform Majalah Sekolah Digital

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
</p>

Platform digital modern untuk majalah sekolah yang memungkinkan siswa, guru, dan admin berkolaborasi dalam membuat dan mengelola konten artikel sekolah.

## 🎆 Fitur Utama

### 👥 Sistem Multi-Role
- **Admin**: Kelola seluruh sistem, approve artikel, generate laporan
- **Guru/Pembina**: Review dan approve artikel siswa, kelola komentar
- **Siswa**: Buat artikel, berikan komentar, lihat artikel published

### 📝 Manajemen Artikel
- Sistem draft, pending, dan published
- Upload gambar dengan multiple variants (thumbnail, medium, large)
- Kategori artikel yang terorganisir
- Sistem approval workflow untuk artikel siswa
- Counter views untuk tracking popularitas

### 💬 Sistem Komentar Interaktif
- Komentar dengan sistem approval
- Moderasi komentar oleh guru/admin
- Notifikasi real-time untuk komentar baru

### 📈 Dashboard & Laporan
- Dashboard khusus untuk setiap role
- Statistik artikel, komentar, dan user
- Generate laporan komprehensif (artikel, komentar, user, aktivitas)
- Export data dalam format yang mudah dibaca

### 🔒 Keamanan & Validasi
- Sistem autentikasi yang aman
- Role-based access control
- Validasi input yang ketat
- CSRF protection

## 🚀 Alur Sistem

### 1. 📝 Siswa Membuat Artikel
- Siswa login ke sistem
- Membuat artikel baru (judul, isi, kategori, foto)
- Artikel otomatis tersimpan dengan status **"pending"**
- Siswa dapat melihat status artikel di dashboard

### 2. 👩‍🏫 Guru/Admin Review Artikel
- Guru/Admin melihat artikel pending di dashboard
- Review konten artikel melalui halaman "Pending Review"
- Approve artikel → status berubah menjadi **"published"**
- Reject artikel → status berubah menjadi **"rejected"**

### 3. 🌍 Artikel Tampil di E-Mading
- Artikel yang sudah di-approve tampil di halaman utama
- Siswa lain dapat membaca dan memberikan komentar
- Sistem tracking views untuk artikel populer

### 4. 💬 Interaksi Komentar
- Siswa memberikan komentar pada artikel
- Komentar masuk ke sistem approval
- Guru/Admin approve komentar yang sesuai
- Komentar yang di-approve tampil di artikel

### 5. 📈 Generate Laporan
- Admin dapat membuat laporan sistem
- Pilih jenis laporan: artikel, komentar, user, atau aktivitas
- Tentukan periode laporan
- Sistem generate data komprehensif dengan visualisasi

## 🛠️ Instalasi & Setup

### Persyaratan Sistem
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- Database (MySQL/PostgreSQL/SQLite)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd e-mading
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=e_mading
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Migrasi & Seeder**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Setup Storage**
   ```bash
   php artisan storage:link
   ```

7. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```

   Akses aplikasi di: `http://localhost:8000`

## 🔑 Akun Demo

Setelah menjalankan seeder, Anda dapat login dengan akun berikut:

| Role | Username | Password | Akses |
|------|----------|----------|---------|
| **Admin** | `admin` | `password` | Full access, kelola sistem, generate laporan |
| **Guru** | `guru` | `password` | Review artikel, approve komentar |
| **Siswa** | `siswa` | `password` | Buat artikel, beri komentar |

## 📱 Registrasi User Baru

Siswa dan guru baru dapat mendaftar melalui halaman register:
- Akses: `http://localhost:8000/register`
- Pilih role: Siswa atau Guru
- Lengkapi data yang diperlukan
- Akun langsung aktif setelah registrasi

## 📁 Struktur Database

### Tabel Utama
- `users` - Data pengguna (admin, guru, siswa)
- `kategoris` - Kategori artikel
- `artikels` - Data artikel dengan status workflow
- `comments` - Komentar dengan sistem approval
- `likes` - System like untuk artikel
- `reports` - Laporan yang di-generate sistem

### Status Artikel
- `draft` - Artikel dalam tahap penulisan
- `pending` - Menunggu review guru/admin
- `published` - Sudah di-approve dan tampil publik
- `rejected` - Ditolak oleh reviewer

## 🌐 Teknologi yang Digunakan

- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates + Tailwind CSS
- **Database**: MySQL/PostgreSQL/SQLite
- **File Storage**: Laravel Storage (Local/Cloud)
- **Authentication**: Laravel Sanctum
- **Image Processing**: Intervention Image

## 🔧 Fitur Pengembangan

### Sudah Tersedia
- ✅ Multi-role authentication
- ✅ Article workflow (draft → pending → published)
- ✅ Comment moderation system
- ✅ Image upload with variants
- ✅ Comprehensive reporting
- ✅ Responsive design
- ✅ Role-based dashboards

### Roadmap
- 🔄 Real-time notifications
- 🔄 Advanced search & filtering
- 🔄 Article scheduling
- 🔄 Email notifications
- 🔄 Social media integration
- 🔄 Mobile app (PWA)

## 👥 Kontribusi

Kami menerima kontribusi dari komunitas! Silakan:
1. Fork repository ini
2. Buat branch untuk fitur baru
3. Commit perubahan Anda
4. Push ke branch
5. Buat Pull Request

## 📝 Lisensi

Proyek ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk detail lengkap.

## 📧 Kontak & Support

Jika Anda memiliki pertanyaan atau membutuhkan bantuan:
- Buat issue di GitHub repository
- Email: support@e-mading.sch.id
- Dokumentasi: [Wiki Repository]

---

**Dibuat dengan ❤️ untuk kemajuan pendidikan digital Indonesia**
