<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            DemoDataSeeder::class,
        ]);
        
        // Keep existing data for compatibility
        $admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'nama' => 'Administrator',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        $guru = User::firstOrCreate(
            ['username' => 'guru'],
            [
                'nama' => 'Pembina',
                'password' => bcrypt('password'),
                'role' => 'guru',
            ]
        );

        $siswa = User::firstOrCreate(
            ['username' => 'siswa'],
            [
                'nama' => 'Siswa',
                'password' => bcrypt('password'),
                'role' => 'siswa',
            ]
        );

        // Create default categories
        $kategoris = [
            'Prestasi',
            'Opini',
            'Kegiatan',
            'Informasi Sekolah',
            'Karya Tulis',
            'Lomba',
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create([
                'nama_kategori' => $kategori,
            ]);
        }

        // Create sample articles dengan gambar yang sesuai
        $artikelData = [
            [
                'judul' => 'Selamat Datang di Era Digital: E-Mading Resmi Diluncurkan!',
                'isi' => 'Dengan bangga kami umumkan peluncuran E-Mading Digital sekolah kami. Platform ini akan menjadi wadah kreativitas dan informasi bagi seluruh keluarga besar sekolah. Mari bersama-sama membangun budaya literasi digital yang positif dan inspiratif.

Fitur-fitur yang tersedia:
• Publikasi artikel digital
• Kategori yang terorganisir
• Sistem verifikasi yang aman
• Akses 24/7 dari mana saja

Mari kita manfaatkan platform ini untuk berbagi cerita, prestasi, dan informasi penting sekolah.',
                'id_user' => $admin->id_user,
                'id_kategori' => 4, // Informasi Sekolah
                'status' => 'published',
                'views' => 150,
                'foto' => 'digital-mading-launch.jpg',
            ],
            [
                'judul' => 'Siswa Kita Raih Medali Emas Olimpiade Sains Nasional 2024',
                'isi' => 'Kebanggaan besar bagi sekolah kita! Muhammad Rizki, siswa kelas 12 IPA, berhasil meraih medali emas dalam Olimpiade Sains Nasional 2024 di bidang Fisika. Prestasi ini merupakan hasil dari kerja keras dan dedikasi yang luar biasa.

"Selama 6 bulan saya berlatih intensif dengan bimbingan guru pembina. Saya sangat bersyukur bisa mengharumkan nama sekolah," ujar Rizki.

Prestasi yang diraih:
🥇 Medali Emas Fisika
📊 Nilai tertinggi nasional
🎯 Predikat Outstanding

Selamat kepada Rizki dan tim pembina! Semoga menjadi inspirasi bagi siswa lainnya.',
                'id_user' => $guru->id_user,
                'id_kategori' => 1, // Prestasi
                'status' => 'published',
                'views' => 285,
                'foto' => 'olimpiade-sains-medali.jpg',
            ],
            [
                'judul' => 'Festival Seni dan Budaya 2024: Merayakan Keberagaman',
                'isi' => 'Dalam rangka memperingati Hari Pendidikan Nasional, sekolah akan mengadakan Festival Seni dan Budaya pada tanggal 15-17 Mei 2024. Acara ini menampilkan berbagai pertunjukan seni, pameran karya siswa, dan bazar kuliner tradisional.

Jadwal Kegiatan:
🎭 15 Mei: Pentas Seni (Tari, Musik, Teater)
🎨 16 Mei: Pameran Karya Seni Siswa
🍲 17 Mei: Bazar Kuliner Nusantara

"Festival ini menjadi wadah bagi siswa untuk mengekspresikan kreativitas dan melestarikan budaya Indonesia," kata Bu Sari, ketua panitia.

Ayo ramaikan acara ini dan dukung bakat seni teman-teman kita!',
                'id_user' => $siswa->id_user,
                'id_kategori' => 3, // Kegiatan
                'status' => 'published',
                'views' => 198,
                'foto' => 'festival-seni-budaya.jpg',
            ],
            [
                'judul' => 'Opini: Pentingnya Literasi Digital di Kalangan Pelajar',
                'isi' => 'Di era teknologi yang semakin maju, literasi digital bukan lagi pilihan tapi kebutuhan. Sebagai pelajar, kita harus mampu memanfaatkan teknologi secara positif untuk pengembangan diri dan kontribusi kepada masyarakat.

Mengapa literasi digital penting?
🔍 Akses informasi yang luas
💡 Pengembangan keterampilan baru
🌐 Jejaring yang lebih luas
🚀 Persiapan masa depan

"Teknologi adalah alat, bagaimana kita menggunakannya yang menentukan hasilnya," tulis Andi dalam opininya.

Mari menjadi pelajar yang cerdas dan bertanggung jawab dalam menggunakan teknologi digital!',
                'id_user' => $siswa->id_user,
                'id_kategori' => 2, // Opini
                'status' => 'published',
                'views' => 167,
                'foto' => 'literasi-digital-pelajar.jpg',
            ],
            [
                'judul' => 'Workshop Coding dan Robotics untuk Siswa SMP-SMA',
                'isi' => 'Bagi yang tertarik dengan programming dan robotics, jangan lewatkan workshop gratis yang akan diadakan setiap Sabtu mulai minggu depan. Daftar segera karena kuota terbatas!

Materi Workshop:
💻 Dasar-dasar Pemrograman Python
🤖 Pengenalan Robotika
🎮 Pembuatan Game Sederhana
📱 Pengembangan Aplikasi Mobile

Fasilitas:
• Sertifikat peserta
• Kit robotics untuk praktik
• Mentoring dari ahli
• Snack dan makan siang

Pendaftaran dibuka sampai kuota terpenuhi. Ayo daftar sekarang!',
                'id_user' => $guru->id_user,
                'id_kategori' => 6, // Lomba
                'status' => 'published',
                'views' => 223,
                'foto' => 'workshop-coding-robotics.jpg',
            ],
        ];

        foreach ($artikelData as $data) {
            Artikel::create(array_merge($data, [
                'tanggal' => now(),
            ]));
        }

        // Copy sample images to storage
        $this->copySampleImages();
    }

    private function copySampleImages()
    {
        $sampleImages = [
            'digital-mading-launch.jpg' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
            'olimpiade-sains-medali.jpg' => 'https://images.unsplash.com/photo-1536922246289-88c42f957773?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2104&q=80',
            'festival-seni-budaya.jpg' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
            'literasi-digital-pelajar.jpg' => 'https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2069&q=80',
            'workshop-coding-robotics.jpg' => 'https://images.unsplash.com/photo-1555255707-c07966088b7b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
        ];

        foreach ($sampleImages as $filename => $url) {
            $imageContent = @file_get_contents($url);
            if ($imageContent !== false) {
                Storage::put('public/artikels/' . $filename, $imageContent);
            }
        }
    }
}