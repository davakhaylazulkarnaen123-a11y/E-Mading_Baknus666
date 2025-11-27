<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Kategori;

class TestController extends Controller
{
    public function createArtikel()
    {
        $kategoris = Kategori::all();
        return view('artikel.create', compact('kategoris'));
    }
    
    public function previewArtikel()
    {
        $user = auth()->user();
        
        if (!$user->isAdmin() && !$user->isGuru()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak');
        }
        
        $artikels = Artikel::with(['kategori', 'user', 'likes', 'comments'])
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('dashboard.preview', compact('artikels'));
    }
}