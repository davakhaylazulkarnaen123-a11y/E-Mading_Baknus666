<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Kategori;

class HomeController extends Controller
{
    public function index()
    {
        // Get published articles for public view
        $artikels = Artikel::with(['kategori', 'user', 'likes'])
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        $kategoris = Kategori::all();
        
        // Get popular articles (most viewed)
        $artikelsPopuler = Artikel::with(['kategori', 'user'])
            ->where('status', 'published')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
        
        return view('welcome-combined', compact('artikels', 'kategoris', 'artikelsPopuler'));
    }
}