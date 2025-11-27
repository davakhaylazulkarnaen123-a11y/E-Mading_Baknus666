<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ImageSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk memastikan file gambar sample ada.
     */
    public function run()
    {
        $filenames = [
            'digital-mading-launch.jpg',
            'olimpiade-sains-medali.jpg',
            'festival-seni-budaya.jpg',
            'literasi-digital-pelajar.jpg',
            'workshop-coding-robotics.jpg',
            'quality_restoration_20250909220945445.jpg',
            'storage/app/public/artikels/download (4).jpg',
            'storage/app/public/artikels/feed instagram.jpg',
            'storage/app/public/artikels/Template Canva - Merah Emas dan Biru Karnaval Budaya Tradisional Kemerdekaan RI Banner.jpg',
            'storage/app/public/artikels/Collaborative robotics flat modern design illustration _ Premium Vector.jpg',
            'storage/app/public/artikels/How to Create and Sell Digital Products Without Any Experience.jpg',
            'storage/app/public/artikels/download (5).jpg',
            'storage/app/public/artikels/lomba basket.jpg',
            'public/storage/artikels/download (4).jpeg',
            'public/storage/artikels/download (5).jpeg',
            'public/storage/artikels/Online games concept _ Premium Vector.jpeg',
            'c:\Users\Acer\Downloads\download (6).jpeg',
            'public/storage/artikels/download (7).jpeg',
            'public/storage/artikels/download (8).jpeg',
        ];

        $default = 'public/artikels/default-artikel.svg';

        foreach ($filenames as $file) {
            $path = 'public/artikels/' . $file;
            if (!Storage::exists($path)) {
                // Jika file spesifik tidak ada, salin default sebagai nama file itu
                if (Storage::exists($default)) {
                    Storage::copy($default, $path);
                } else {
                    // fallback: buat file kosong agar tidak broken
                    Storage::put($path, '');
                }
            }
        }

        $this->command->info('ImageSeeder: ensured sample article images exist (copied default where missing).');
    }
}
