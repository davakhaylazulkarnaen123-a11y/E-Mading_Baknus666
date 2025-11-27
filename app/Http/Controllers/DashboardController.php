<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $user = auth()->user();
            
            if (!$user) {
                return redirect()->route('login');
            }
            
            // Initialize default values
            $totalArtikel = 0;
            $artikelPublished = 0;
            $artikelDraft = 0;
            $artikelPending = 0;
            $totalViews = 0;
            $artikelTerbaru = collect();
            
            if ($user->isAdmin() || $user->isGuru()) {
                // Admin/Guru Dashboard - semua artikel
                $totalArtikel = Artikel::count();
                $artikelPublished = Artikel::where('status', 'published')->count();
                $artikelPending = Artikel::where('status', 'pending')->count();
                $artikelDraft = Artikel::where('status', 'draft')->count();
                $totalViews = Artikel::sum('views') ?? 0;
                $totalUsers = User::count();
                $komentarPending = Comment::where('is_approved', false)->count();
                
                // Artikel terbaru dari semua user
                $artikelTerbaru = Artikel::with(['kategori', 'user'])
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
                    
                // Published articles for preview
                $publishedArticles = Artikel::where('status', 'published')->count();
                    
                // Data untuk admin dashboard
                $artikelPendingReview = Artikel::with(['user'])
                    ->where('status', 'pending')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
                    
                $komentarPendingApproval = Comment::with(['user', 'artikel'])
                    ->where('is_approved', false)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
                    
                return view('dashboard.modern', compact(
                    'totalArtikel', 
                    'artikelPublished', 
                    'artikelDraft',
                    'artikelPending',
                    'totalViews',
                    'totalUsers',
                    'komentarPending',
                    'artikelTerbaru',
                    'artikelPendingReview',
                    'komentarPendingApproval',
                    'publishedArticles'
                ));
            } else {
                // Siswa Dashboard - hanya artikel milik user
                $totalArtikel = Artikel::where('id_user', $user->id_user)->count();
                $artikelPublished = Artikel::where('id_user', $user->id_user)
                    ->where('status', 'published')
                    ->count();
                $artikelDraft = Artikel::where('id_user', $user->id_user)
                    ->where('status', 'draft')
                    ->count();
                $artikelPending = Artikel::where('id_user', $user->id_user)
                    ->where('status', 'pending')
                    ->count();
                $totalViews = Artikel::where('id_user', $user->id_user)
                    ->sum('views') ?? 0;
                
                // Artikel terbaru milik user
                $artikelTerbaru = Artikel::with(['kategori'])
                    ->where('id_user', $user->id_user)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
                    
                // Published articles count for all users (for students to see total published)
                $publishedArticles = Artikel::where('status', 'published')->count();
                
                // Notifikasi untuk siswa
                $notifications = [];
                try {
                    if (\Schema::hasTable('notifications')) {
                        $notifications = $user->notifications()
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
                    }
                } catch (\Exception $e) {
                    $notifications = collect();
                }
                
                return view('dashboard.modern', compact(
                    'totalArtikel', 
                    'artikelPublished', 
                    'artikelDraft',
                    'artikelPending',
                    'totalViews',
                    'artikelTerbaru',
                    'publishedArticles',
                    'notifications'
                ));
            }
            

            
        } catch (\Exception $e) {
            \Log::error('Dashboard Error: ' . $e->getMessage());
            
            // Return safe defaults jika ada error
            return view('dashboard.modern', [
                'totalArtikel' => 0,
                'artikelPublished' => 0,
                'artikelDraft' => 0,
                'artikelPending' => 0,
                'totalViews' => 0,
                'artikelTerbaru' => collect()
            ]);
        }
    }

    public function preview()
    {
        $user = auth()->user();
        
        // Only admin and guru can access preview
        if (!$user->isAdmin() && !$user->isGuru()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak');
        }
        
        // Get published articles with relationships
        $artikels = Artikel::with(['kategori', 'user', 'likes', 'comments'])
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('dashboard.preview', compact('artikels'));
    }
}