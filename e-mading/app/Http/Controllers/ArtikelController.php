<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class ArtikelController extends Controller
{
    protected $imageService;
    
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->middleware('auth')->except(['show']);
    }
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            // Admin melihat semua artikel
            $artikels = Artikel::with(['user', 'kategori'])->latest()->paginate(12);
        } elseif ($user->isGuru()) {
            // Guru melihat semua artikel untuk moderasi
            $artikels = Artikel::with(['user', 'kategori'])->latest()->paginate(12);
        } else {
            // Siswa hanya melihat artikel miliknya
            $artikels = Artikel::with(['user', 'kategori'])
                ->where('id_user', $user->id_user)
                ->latest()
                ->paginate(12);
        }

        return view('artikel.index', compact('artikels'));
    }

    public function show(Artikel $artikel)
    {
        // Hanya tampilkan artikel yang published untuk guest
        if (!auth()->check() && $artikel->status !== 'published') {
            abort(404);
        }
        
        // Load relasi yang diperlukan
        $artikel->load(['user', 'kategori', 'comments.user', 'likes']);
        
        // Increment view count
        $artikel->increment('views');
        
        // Artikel lainnya dari kategori yang sama
        $relatedArticles = Artikel::where('id_kategori', $artikel->id_kategori)
            ->where('id_artikel', '!=', $artikel->id_artikel)
            ->where('status', 'published')
            ->with(['user', 'kategori'])
            ->latest()
            ->take(3)
            ->get();
        
        return view('artikel.show', compact('artikel', 'relatedArticles'));
    }

    public function edit(Artikel $artikel)
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->id_user !== $artikel->id_user) {
            abort(403, 'Unauthorized');
        }
        
        $kategoris = Kategori::all();
        return view('artikel.edit', compact('artikel', 'kategoris'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->id_user !== $artikel->id_user) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($artikel->foto) {
                $this->imageService->deleteArticleImages($artikel->foto);
            }
            
            try {
                $imageData = $this->imageService->uploadArticleImage($request->file('foto'));
                $data['foto'] = $imageData['original'];
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage())->withInput();
            }
        }

        $artikel->update($data);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Artikel $artikel)
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->id_user !== $artikel->id_user) {
            abort(403, 'Unauthorized');
        }
        
        $artikel->delete();
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }

    public function publish(Artikel $artikel)
    {
        // Hanya pemilik artikel atau admin/guru yang bisa publish
        $user = auth()->user();
        if (!$user->isAdmin() && !$user->isGuru() && $artikel->id_user !== $user->id_user) {
            abort(403, 'Tidak memiliki akses untuk mempublikasi artikel ini');
        }
        
        // Siswa hanya bisa publish artikel draft milik sendiri, artikel akan jadi pending
        if ($user->isSiswa() && $artikel->id_user === $user->id_user && $artikel->status === 'draft') {
            $artikel->update(['status' => 'pending']);
            return back()->with('success', 'Artikel berhasil dikirim untuk review!');
        }
        
        // Admin/Guru bisa langsung publish
        if ($user->isAdmin() || $user->isGuru()) {
            $artikel->update(['status' => 'published']);
            return back()->with('success', 'Artikel berhasil dipublikasikan!');
        }
        
        return back()->with('error', 'Tidak dapat mempublikasi artikel ini.');
    }

    public function unpublish(Artikel $artikel)
    {
        // Hanya pemilik artikel atau admin yang bisa unpublish
        $user = auth()->user();
        if (!$user->isAdmin() && $artikel->id_user !== $user->id_user) {
            abort(403, 'Tidak memiliki akses untuk mengubah status artikel ini');
        }
        
        $artikel->update(['status' => 'draft']);
        return back()->with('success', 'Artikel berhasil dijadikan draft!');
    }
    
    public function approve(Artikel $artikel)
    {
        // Hanya guru dan admin yang bisa approve
        if (!auth()->user()->isAdmin() && !auth()->user()->isGuru()) {
            abort(403, 'Hanya guru dan admin yang dapat menyetujui artikel');
        }
        
        // Hanya artikel pending yang bisa di-approve
        if ($artikel->status !== 'pending') {
            return back()->with('error', 'Hanya artikel pending yang dapat disetujui!');
        }
        
        $artikel->update(['status' => 'published']);
        return back()->with('success', 'Artikel "' . $artikel->judul . '" berhasil disetujui dan dipublikasikan!');
    }
    
    public function reject(Artikel $artikel)
    {
        // Hanya guru dan admin yang bisa reject
        if (!auth()->user()->isAdmin() && !auth()->user()->isGuru()) {
            abort(403, 'Hanya guru dan admin yang dapat menolak artikel');
        }
        
        // Hanya artikel pending yang bisa di-reject
        if ($artikel->status !== 'pending') {
            return back()->with('error', 'Hanya artikel pending yang dapat ditolak!');
        }
        
        $artikel->update(['status' => 'rejected']);
        return back()->with('success', 'Artikel "' . $artikel->judul . '" ditolak.');
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('artikel.create-advanced', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        $fotoName = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fotoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/artikels', $fotoName);
        }

        $user = auth()->user();
        
        // Determine status based on user role
        if ($user->isSiswa()) {
            $status = 'pending'; // Siswa selalu pending untuk review
        } else {
            $status = 'published'; // Guru/Admin bisa langsung publish
        }
        
        Artikel::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'id_kategori' => $request->id_kategori,
            'id_user' => $user->id_user,
            'tanggal' => now(),
            'foto' => $fotoName,
            'status' => $status
        ]);

        $message = $status === 'pending' 
            ? 'Artikel berhasil dibuat dan menunggu persetujuan!' 
            : 'Artikel berhasil dibuat dan dipublikasikan!';

        return redirect()->route('dashboard')->with('success', $message);
    }

    // ... method lainnya tetap sama
}