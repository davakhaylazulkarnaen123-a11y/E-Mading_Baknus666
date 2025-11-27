<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    public function getImages()
    {
        $files = Storage::disk('public')->files('artikels');
        $images = [];
        
        foreach ($files as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $images[] = [
                    'name' => basename($file),
                    'path' => $file,
                    'url' => Storage::disk('public')->url($file),
                    'size' => Storage::disk('public')->size($file),
                    'modified' => Storage::disk('public')->lastModified($file)
                ];
            }
        }
        
        return response()->json($images);
    }
}
