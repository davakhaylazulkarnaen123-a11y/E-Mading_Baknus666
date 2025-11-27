<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Artikel;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create Users
        $admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'nama' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );

        $guru = User::firstOrCreate(
            ['username' => 'guru'],
            [
                'nama' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'guru'
            ]
        );

        $siswa1 = User::firstOrCreate(
            ['username' => 'siswa'],
            [
                'nama' => 'Siti Nurhaliza',
                'password' => Hash::make('password'),
                'role' => 'siswa'
            ]
        );

        $siswa2 = User::firstOrCreate(
            ['username' => 'ahmad'],
            [
                'nama' => 'Ahmad Rizki',
                'password' => Hash::make('password'),
                'role' => 'siswa'
            ]
        );

        // Create Categories
        $kategori1 = Kategori::create([
            'nama_kategori' => 'Berita Sekolah'
        ]);

        $kategori2 = Kategori::create([
            'nama_kategori' => 'Prestasi Siswa'
        ]);

        $kategori3 = Kategori::create([
            'nama_kategori' => 'Artikel Ilmiah'
        ]);

        $kategori4 = Kategori::create([
            'nama_kategori' => 'Opini & Esai'
        ]);

        // Create Articles - Admin dapat langsung publish
        Artikel::create([
            'judul' => 'Selamat Datang di E-Mading Digital Sekolah',
            'isi' => '<p>Selamat datang di platform E-Mading Digital sekolah kita! Platform ini dirancang khusus untuk menjadi wadah kreativitas dan berbagi informasi bagi seluruh komunitas sekolah.</p>

<h3>Fitur Utama:</h3>
<ul>
<li>Publikasi artikel dan berita sekolah</li>
<li>Sistem review dan approval untuk menjaga kualitas konten</li>
<li>Kategori artikel yang beragam</li>
<li>Sistem komentar interaktif</li>
<li>Dashboard khusus untuk setiap role pengguna</li>
</ul>

<p>Mari bersama-sama membangun budaya literasi digital yang positif dan inspiratif!</p>',
            'id_kategori' => $kategori1->id_kategori,
            'id_user' => $admin->id_user,
            'tanggal' => now(),
            'status' => 'published',
            'views' => 45
        ]);

        // Artikel dari Guru - bisa langsung publish
        Artikel::create([
            'judul' => 'Tips Menulis Artikel yang Menarik untuk E-Mading',
            'isi' => '<p>Menulis artikel yang menarik memerlukan teknik dan strategi khusus. Berikut adalah beberapa tips yang dapat membantu:</p>

<h3>1. Pilih Topik yang Relevan</h3>
<p>Pilih topik yang dekat dengan kehidupan sekolah dan menarik bagi pembaca.</p>

<h3>2. Buat Judul yang Menarik</h3>
<p>Judul adalah hal pertama yang dilihat pembaca. Buatlah judul yang informatif namun menarik perhatian.</p>

<h3>3. Gunakan Bahasa yang Mudah Dipahami</h3>
<p>Hindari penggunaan bahasa yang terlalu formal atau rumit. Gunakan bahasa yang komunikatif.</p>

<h3>4. Sertakan Gambar Pendukung</h3>
<p>Gambar dapat membuat artikel lebih menarik dan mudah dipahami.</p>

<p>Selamat menulis dan berbagi inspirasi!</p>',
            'id_kategori' => $kategori4->id_kategori,
            'id_user' => $guru->id_user,
            'tanggal' => now()->subDays(2),
            'status' => 'published',
            'views' => 32
        ]);

        // Artikel dari Siswa - otomatis status pending untuk review
        $artikel_pending = Artikel::create([
            'judul' => 'Pengalaman Mengikuti Olimpiade Sains Nasional',
            'isi' => '<p>Bulan lalu, saya berkesempatan mengikuti Olimpiade Sains Nasional bidang Matematika. Pengalaman ini sangat berharga dan memberikan banyak pelajaran.</p>

<h3>Persiapan yang Matang</h3>
<p>Persiapan dimulai sejak 6 bulan sebelumnya dengan belajar intensif dan mengerjakan soal-soal latihan.</p>

<h3>Hari Pelaksanaan</h3>
<p>Kompetisi berlangsung selama 2 hari dengan berbagai tahapan yang menantang.</p>

<h3>Hasil dan Refleksi</h3>
<p>Meskipun belum meraih juara, pengalaman ini mengajarkan pentingnya kerja keras dan pantang menyerah.</p>',
            'id_kategori' => $kategori2->id_kategori,
            'id_user' => $siswa1->id_user,
            'tanggal' => now()->subHours(3),
            'status' => 'pending', // Siswa artikel otomatis pending
            'views' => 0
        ]);

        // Artikel siswa yang sudah di-approve guru
        Artikel::create([
            'judul' => 'Dampak Teknologi Digital terhadap Pembelajaran Modern',
            'isi' => '<p>Era digital telah mengubah cara kita belajar dan mengajar. Teknologi memberikan berbagai kemudahan namun juga tantangan baru.</p>

<h3>Keuntungan Teknologi dalam Pembelajaran:</h3>
<ul>
<li>Akses informasi yang lebih luas</li>
<li>Pembelajaran yang lebih interaktif</li>
<li>Fleksibilitas waktu dan tempat belajar</li>
<li>Pengembangan keterampilan digital</li>
</ul>

<h3>Tantangan yang Dihadapi:</h3>
<ul>
<li>Ketergantungan berlebihan pada teknologi</li>
<li>Berkurangnya interaksi sosial langsung</li>
<li>Kesenjangan akses teknologi</li>
</ul>

<p>Penting bagi kita untuk memanfaatkan teknologi secara bijak dalam proses pembelajaran.</p>',
            'id_kategori' => $kategori3->id_kategori,
            'id_user' => $siswa2->id_user,
            'tanggal' => now()->subDays(1),
            'status' => 'published', // Sudah di-approve
            'views' => 28
        ]);
        
        // Artikel siswa yang ditolak
        Artikel::create([
            'judul' => 'Review Game Mobile Terbaru',
            'isi' => '<p>Game mobile terbaru yang lagi hits banget nih guys! Grafisnya keren abis dan gameplaynya seru banget.</p>

<p>Tapi sayangnya masih ada bug di beberapa level. Overall sih oke lah buat ngisi waktu luang.</p>',
            'id_kategori' => $kategori4->id_kategori,
            'id_user' => $siswa2->id_user,
            'tanggal' => now()->subDays(3),
            'status' => 'rejected', // Ditolak karena tidak sesuai standar
            'views' => 0
        ]);
        
        // Artikel draft dari siswa
        Artikel::create([
            'judul' => 'Kegiatan Ekstrakurikuler Robotika',
            'isi' => '<p>Ekstrakurikuler robotika di sekolah kita sangat menarik. Kami belajar membuat robot sederhana dan memprogram gerakan-gerakannya.</p>

<h3>Yang Dipelajari:</h3>
<ul>
<li>Dasar-dasar elektronika</li>
<li>Pemrograman Arduino</li>
<li>Desain mekanik robot</li>
<li>Kerja sama tim</li>
</ul>

<p>Tahun ini kami berencana mengikuti kompetisi robotika tingkat provinsi.</p>',
            'id_kategori' => $kategori2->id_kategori,
            'id_user' => $siswa1->id_user,
            'tanggal' => now()->subHours(1),
            'status' => 'draft', // Masih draft, belum di-submit
            'views' => 0
        ]);

        // Create Comments
        $artikel_published = Artikel::where('status', 'published')->first();
        
        Comment::create([
            'id_artikel' => $artikel_published->id_artikel,
            'id_user' => $siswa1->id_user,
            'isi_komentar' => 'Artikel yang sangat informatif! Terima kasih sudah berbagi tips menulis yang bermanfaat.',
            'is_approved' => true
        ]);

        Comment::create([
            'id_artikel' => $artikel_published->id_artikel,
            'id_user' => $siswa2->id_user,
            'isi_komentar' => 'Setuju sekali dengan poin-poin yang disampaikan. Akan saya terapkan dalam menulis artikel selanjutnya.',
            'is_approved' => true
        ]);

        // Pending comment
        Comment::create([
            'id_artikel' => $artikel_published->id_artikel,
            'id_user' => $siswa1->id_user,
            'isi_komentar' => 'Apakah ada workshop menulis yang bisa diikuti siswa?',
            'is_approved' => false
        ]);
    }
}