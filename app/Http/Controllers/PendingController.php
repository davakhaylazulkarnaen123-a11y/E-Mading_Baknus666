<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Support\Facades\Schema;

class PendingController extends Controller
{
    public function __construct()
    {
        $this->middleware('guru'); // Hanya guru dan admin
    }
    
    public function articles()
    {
        $artikels = Artikel::with(['user', 'kategori'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.pending.articles', compact('artikels'));
    }

    public function comments()
    {
        $comments = Comment::with(['user', 'artikel'])
            ->where('is_approved', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.pending.comments', compact('comments'));
    }
    
    public function approveArticle(Request $request, Artikel $artikel)
    {
        $updateData = ['status' => 'published'];
        
        if (\Schema::hasColumn('artikels', 'reviewed_at')) {
            $updateData['reviewed_at'] = now();
        }
        
        if (\Schema::hasColumn('artikels', 'reviewed_by')) {
            $updateData['reviewed_by'] = auth()->id();
        }
        
        if (\Schema::hasColumn('artikels', 'rejection_reason')) {
            $updateData['rejection_reason'] = null;
        }
        
        $artikel->update($updateData);
        
        return redirect()->back()->with('success', 'Artikel berhasil disetujui dan dipublikasikan.');
    }
    
    public function rejectArticle(Request $request, Artikel $artikel)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);
        
        // Update artikel status
        $updateData = ['status' => 'rejected'];
        
        if (\Schema::hasColumn('artikels', 'rejection_reason')) {
            $updateData['rejection_reason'] = $request->rejection_reason;
        }
        
        if (\Schema::hasColumn('artikels', 'reviewed_at')) {
            $updateData['reviewed_at'] = now();
        }
        
        if (\Schema::hasColumn('artikels', 'reviewed_by')) {
            $updateData['reviewed_by'] = auth()->id();
        }
        
        $artikel->update($updateData);
        
        // Kirim notifikasi ke siswa penulis artikel
        try {
            if (\Schema::hasTable('notifications')) {
                Notification::create([
                    'id_user' => $artikel->id_user,
                    'type' => 'artikel_rejected',
                    'title' => 'Artikel Ditolak',
                    'message' => "Artikel '{$artikel->judul}' ditolak. Alasan: {$request->rejection_reason}",
                    'data' => [
                        'artikel_id' => $artikel->id_artikel,
                        'artikel_judul' => $artikel->judul,
                        'rejection_reason' => $request->rejection_reason,
                        'reviewer' => auth()->user()->nama
                    ]
                ]);
            }
        } catch (\Exception $e) {
            // Jika tabel notifications belum ada, skip notifikasi
        }
        
        return redirect()->back()->with('success', 'Artikel berhasil ditolak dan notifikasi telah dikirim ke siswa.');
    }
}