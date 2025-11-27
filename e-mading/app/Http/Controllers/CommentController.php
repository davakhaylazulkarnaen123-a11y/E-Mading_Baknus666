<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Artikel;
use App\Helpers\ProfanityFilter;

class CommentController extends Controller
{
    public function store(Request $request, Artikel $artikel)
    {
        $request->validate([
            'comment' => 'required|min:3|max:500'
        ]);

        // Filter kata kasar
        $filteredComment = ProfanityFilter::filter($request->comment);
        
        // Cek apakah ada kata kasar untuk memberi peringatan
        $hasWarning = ProfanityFilter::containsBadWords($request->comment);

        Comment::create([
            'id_artikel' => $artikel->id_artikel,
            'id_user' => auth()->user()->id_user,
            'isi_komentar' => $filteredComment,
            'is_approved' => true // Langsung approved
        ]);

        if ($hasWarning) {
            return back()->with('warning', 'Komentar berhasil dikirim, namun kata tidak pantas telah disensor.');
        }

        return back()->with('success', 'Komentar berhasil dikirim!');
    }

    public function approve(Comment $comment)
    {
        // Hanya guru dan admin yang bisa approve komentar
        if (!auth()->user()->isAdmin() && !auth()->user()->isGuru()) {
            abort(403, 'Hanya guru dan admin yang dapat menyetujui komentar');
        }

        $comment->update(['is_approved' => true]);
        return back()->with('success', 'Komentar berhasil disetujui dan dipublikasikan.');
    }

    public function destroy(Comment $comment)
    {
        // Hanya pengirim yang bisa hapus komentar sendiri
        if (auth()->user()->id_user !== $comment->id_user) {
            abort(403, 'Anda hanya bisa menghapus komentar sendiri.');
        }

        $comment->delete();
        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}