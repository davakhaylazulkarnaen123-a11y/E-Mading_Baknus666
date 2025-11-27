<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Artikel;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('user')->latest()->paginate(10);
        return view('admin.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jenis' => 'required|in:artikel,komentar,user,aktivitas'
        ]);

        $data = $this->generateReportData($request->jenis, $request->tanggal_mulai, $request->tanggal_selesai);

        Report::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jenis' => $request->jenis,
            'data' => $data,
            'id_user' => auth()->user()->id_user
        ]);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dibuat!');
    }

    public function show(Report $report)
    {
        return view('admin.reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        return view('admin.reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jenis' => 'required|in:artikel,komentar,user,aktivitas'
        ]);

        // Regenerate data jika tanggal atau jenis berubah
        if ($report->tanggal_mulai != $request->tanggal_mulai || 
            $report->tanggal_selesai != $request->tanggal_selesai || 
            $report->jenis != $request->jenis) {
            $data = $this->generateReportData($request->jenis, $request->tanggal_mulai, $request->tanggal_selesai);
        } else {
            $data = $report->data;
        }

        $report->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jenis' => $request->jenis,
            'data' => $data
        ]);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus!');
    }

    private function generateReportData($jenis, $tanggalMulai, $tanggalSelesai)
    {
        $startDate = Carbon::parse($tanggalMulai);
        $endDate = Carbon::parse($tanggalSelesai);

        switch ($jenis) {
            case 'artikel':
                return $this->generateArtikelReport($startDate, $endDate);
            case 'komentar':
                return $this->generateKomentarReport($startDate, $endDate);
            case 'user':
                return $this->generateUserReport($startDate, $endDate);
            case 'aktivitas':
                return $this->generateAktivitasReport($startDate, $endDate);
            default:
                return [];
        }
    }

    private function generateArtikelReport($startDate, $endDate)
    {
        $artikels = Artikel::with(['user', 'kategori'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        return [
            'total_artikel' => $artikels->count(),
            'artikel_published' => $artikels->where('status', 'published')->count(),
            'artikel_draft' => $artikels->where('status', 'draft')->count(),
            'artikel_pending' => $artikels->where('status', 'pending')->count(),
            'artikel_by_kategori' => $artikels->groupBy('kategori.nama_kategori')->map->count(),
            'artikel_by_user' => $artikels->groupBy('user.nama')->map->count(),
            'detail_artikel' => $artikels->map(function($artikel) {
                return [
                    'judul' => $artikel->judul,
                    'penulis' => $artikel->user->nama,
                    'kategori' => $artikel->kategori->nama_kategori ?? 'Tidak ada',
                    'status' => $artikel->status,
                    'tanggal' => $artikel->created_at->format('d/m/Y'),
                    'views' => $artikel->views ?? 0
                ];
            })
        ];
    }

    private function generateKomentarReport($startDate, $endDate)
    {
        $comments = Comment::with(['user', 'artikel'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        return [
            'total_komentar' => $comments->count(),
            'komentar_approved' => $comments->where('is_approved', true)->count(),
            'komentar_pending' => $comments->where('is_approved', false)->count(),
            'komentar_by_user' => $comments->groupBy('user.nama')->map->count(),
            'detail_komentar' => $comments->map(function($comment) {
                return [
                    'isi' => substr($comment->isi_komentar, 0, 100) . '...',
                    'penulis' => $comment->user->nama,
                    'artikel' => $comment->artikel->judul,
                    'status' => $comment->is_approved ? 'Approved' : 'Pending',
                    'tanggal' => $comment->created_at->format('d/m/Y H:i')
                ];
            })
        ];
    }

    private function generateUserReport($startDate, $endDate)
    {
        $users = User::whereBetween('created_at', [$startDate, $endDate])->get();

        return [
            'total_user_baru' => $users->count(),
            'user_by_role' => $users->groupBy('role')->map->count(),
            'detail_user' => $users->map(function($user) {
                return [
                    'nama' => $user->nama,
                    'username' => $user->username,
                    'role' => $user->role,
                    'tanggal_daftar' => $user->created_at->format('d/m/Y'),
                    'total_artikel' => $user->artikels()->count(),
                    'total_komentar' => $user->comments()->count()
                ];
            })
        ];
    }

    private function generateAktivitasReport($startDate, $endDate)
    {
        $artikels = Artikel::whereBetween('created_at', [$startDate, $endDate])->count();
        $comments = Comment::whereBetween('created_at', [$startDate, $endDate])->count();
        $users = User::whereBetween('created_at', [$startDate, $endDate])->count();

        return [
            'artikel_baru' => $artikels,
            'komentar_baru' => $comments,
            'user_baru' => $users,
            'total_aktivitas' => $artikels + $comments + $users,
            'aktivitas_harian' => $this->getActivityByDay($startDate, $endDate)
        ];
    }

    private function getActivityByDay($startDate, $endDate)
    {
        $activities = [];
        $current = $startDate->copy();

        while ($current <= $endDate) {
            $dayStart = $current->copy()->startOfDay();
            $dayEnd = $current->copy()->endOfDay();

            $activities[$current->format('Y-m-d')] = [
                'artikel' => Artikel::whereBetween('created_at', [$dayStart, $dayEnd])->count(),
                'komentar' => Comment::whereBetween('created_at', [$dayStart, $dayEnd])->count(),
                'user' => User::whereBetween('created_at', [$dayStart, $dayEnd])->count()
            ];

            $current->addDay();
        }

        return $activities;
    }
}