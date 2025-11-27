<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function uploadArticleImage(UploadedFile $file, $folder = 'artikels'): array
    {
        $this->validateImage($file);
        $filename = $this->generateFilename($file);
        
        // Pastikan direktori ada
        if (!Storage::exists("public/{$folder}")) {
            Storage::makeDirectory("public/{$folder}");
        }
        
        // Upload file ke storage
        $path = $file->storeAs("public/{$folder}", $filename);
        
        // Log untuk debug
        \Log::info('File uploaded', [
            'filename' => $filename,
            'path' => $path,
            'storage_path' => storage_path("app/public/{$folder}/{$filename}"),
            'exists' => file_exists(storage_path("app/public/{$folder}/{$filename}"))
        ]);
        
        return [
            'original' => $filename,
            'thumbnail' => $filename,
            'medium' => $filename
        ];
    }
    
    private function validateImage(UploadedFile $file): void
    {
        $maxSize = 5 * 1024 * 1024; // 5MB
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        
        if ($file->getSize() > $maxSize) {
            throw new \Exception('Ukuran file terlalu besar. Maksimal 5MB.');
        }
        
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            throw new \Exception('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
        }
    }
    
    private function generateFilename(UploadedFile $file): string
    {
        return time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    }
    

    
    public function deleteArticleImages(string $filename, string $folder = 'artikels'): void
    {
        Storage::delete("public/{$folder}/{$filename}");
    }
    
    public function getImageUrl(string $filename, string $size = 'original', string $folder = 'artikels'): string
    {
        if (!$filename) return '';
        return asset("storage/{$folder}/{$filename}");
    }
}