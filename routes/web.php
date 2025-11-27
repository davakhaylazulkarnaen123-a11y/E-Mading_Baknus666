<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Models\Artikel;
use App\Models\Comment;

// Route model binding - tidak perlu karena sudah ada di bootstrap/app.php

Route::bind('comment', function ($value) {
    return Comment::where('id_comment', $value)->firstOrFail();
});

Route::bind('report', function ($value) {
    return \App\Models\Report::where('id_report', $value)->firstOrFail();
});

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/csrf-token', function() {
    return response()->json(['token' => csrf_token()]);
});

// Debug route untuk test gambar
Route::get('/test-images', function() {
    $files = \Storage::files('public/artikels');
    $artikels = \App\Models\Artikel::latest()->take(5)->get();
    
    return response()->json([
        'storage_files' => $files,
        'artikels' => $artikels->map(function($artikel) {
            return [
                'id' => $artikel->id_artikel,
                'judul' => $artikel->judul,
                'foto' => $artikel->foto,
                'foto_path' => $artikel->foto ? asset('storage/artikels/' . $artikel->foto) : null,
                'file_exists' => $artikel->foto ? file_exists(public_path('storage/artikels/' . $artikel->foto)) : false
            ];
        })
    ]);
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public artikel show route
Route::get('/artikel/{artikel}', [ArtikelController::class, 'show'])->name('artikel.show');

// Test route untuk debug
Route::get('/test-db', function() {
    $user = auth()->user();
    $kategoris = \App\Models\Kategori::all();
    
    return response()->json([
        'user' => $user,
        'kategoris' => $kategoris,
        'user_id_field' => $user ? $user->id_user : null
    ]);
})->middleware('auth');

// Simple routes for testing
Route::get('/buat-artikel-simple', function() {
    $kategoris = \App\Models\Kategori::all();
    return view('simple-create', compact('kategoris'));
})->middleware('auth')->name('artikel.simple.create');

Route::post('/buat-artikel-simple', function(\Illuminate\Http\Request $request) {
    $request->validate([
        'judul' => 'required|max:255',
        'isi' => 'required|min:10',
        'id_kategori' => 'required|exists:kategoris,id_kategori',
    ]);
    
    $user = auth()->user();
    $status = $user->isSiswa() ? 'pending' : 'draft';
    
    \App\Models\Artikel::create([
        'judul' => $request->judul,
        'isi' => $request->isi,
        'id_kategori' => $request->id_kategori,
        'id_user' => $user->id_user,
        'tanggal' => now(),
        'status' => $status,
    ]);
    
    return redirect()->route('dashboard')->with('success', 'Artikel berhasil dibuat!');
})->middleware('auth')->name('artikel.simple.store');

Route::get('/preview-simple', function() {
    $artikels = \App\Models\Artikel::with(['user', 'likes'])
        ->where('status', 'published')
        ->latest()
        ->get();
    return view('simple-preview', compact('artikels'));
})->middleware('auth')->name('artikel.simple.preview');

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard - semua role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Artikel routes - semua role bisa akses
    Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('/new-article', function() {
        $kategoris = \App\Models\Kategori::all();
        return view('artikel.create-advanced', compact('kategoris'));
    })->name('artikel.create');
    Route::post('/new-article', function(\Illuminate\Http\Request $request) {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required|min:10',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
        
        $user = auth()->user();
        $status = $user->isSiswa() ? 'pending' : 'draft';
        
        $fotoName = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fotoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/artikels', $fotoName);
        }
        
        \App\Models\Artikel::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'id_kategori' => $request->id_kategori,
            'id_user' => $user->id_user,
            'tanggal' => now(),
            'foto' => $fotoName,
            'status' => $status,
        ]);
        
        return redirect()->route('dashboard');
    })->name('artikel.store');
    Route::get('/buat-artikel', function() {
        $kategoris = \App\Models\Kategori::all();
        return view('artikel.create-advanced', compact('kategoris'));
    })->name('artikel.buat');
    Route::post('/simpan-artikel', function(\Illuminate\Http\Request $request) {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required|min:10',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
        ]);
        
        $user = auth()->user();
        $status = $user->isSiswa() ? 'pending' : 'draft';
        
        \App\Models\Artikel::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'id_kategori' => $request->id_kategori,
            'id_user' => $user->id_user,
            'tanggal' => now(),
            'status' => $status,
        ]);
        
        return redirect()->route('dashboard');
    })->name('artikel.simpan');
    Route::get('/artikel/{artikel}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/{artikel}', [ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/{artikel}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');
    
    // Publish artikel - semua role bisa akses (siswa: draft->pending, guru/admin: any->published)
    Route::post('/artikel/{artikel}/publish', [ArtikelController::class, 'publish'])->name('artikel.publish');
    Route::post('/artikel/{artikel}/unpublish', [ArtikelController::class, 'unpublish'])->name('artikel.unpublish');
    
    // Comment dan Like - semua role bisa akses
    Route::post('/artikel/{artikel}/comment', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::post('/artikel/{artikel}/like', [\App\Http\Controllers\LikeController::class, 'toggle'])->name('artikel.like');
    Route::delete('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Notifikasi - semua role bisa akses
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/notifications/{id}', [\App\Http\Controllers\NotificationController::class, 'destroy'])->name('notifications.destroy');
    
    // File Manager
    Route::get('/file-manager/images', [\App\Http\Controllers\FileManagerController::class, 'getImages'])->name('filemanager.images');
    
    // Routes khusus Guru dan Admin
    Route::middleware(['guru'])->group(function () {
        // Preview artikel published - hanya guru/admin
        Route::get('/dashboard/preview', [DashboardController::class, 'preview'])->name('dashboard.preview');
        Route::get('/preview-artikel', [DashboardController::class, 'preview'])->name('preview.artikel');
        
        // Approval artikel - hanya guru/admin
        Route::post('/artikel/{artikel}/approve', [\App\Http\Controllers\PendingController::class, 'approveArticle'])->name('artikel.approve');
        Route::post('/artikel/{artikel}/reject', [\App\Http\Controllers\PendingController::class, 'rejectArticle'])->name('artikel.reject');
        
        
        // Approval komentar - hanya guru/admin
        Route::post('/comments/{comment}/approve', [\App\Http\Controllers\CommentController::class, 'approve'])->name('comments.approve');
        
        // Pending items - hanya guru/admin
        Route::get('/pending/comments', [\App\Http\Controllers\PendingController::class, 'comments'])->name('pending.comments');
        Route::get('/pending/articles', [\App\Http\Controllers\PendingController::class, 'articles'])->name('pending.articles');
    });
    
    // Routes khusus Admin
    Route::middleware(['admin'])->group(function () {
        Route::resource('kategori', KategoriController::class);
        Route::resource('reports', \App\Http\Controllers\ReportController::class);
        Route::resource('user', UserController::class);
    });
    
    // Test routes (temporary)
    Route::get('/test-create', [\App\Http\Controllers\TestController::class, 'createArtikel'])->name('test.create');
    Route::get('/test-preview', [\App\Http\Controllers\TestController::class, 'previewArtikel'])->name('test.preview');
});

// Setup notifications table
Route::get('/setup-notifications', function() {
    try {
        \DB::statement("DROP TABLE IF EXISTS notifications");
        
        \DB::statement("
            CREATE TABLE notifications (
                id_notification BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                id_user BIGINT UNSIGNED NOT NULL,
                type VARCHAR(255) NOT NULL,
                title VARCHAR(255) NOT NULL,
                message TEXT NOT NULL,
                data JSON NULL,
                is_read BOOLEAN DEFAULT FALSE,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL,
                INDEX idx_user_read (id_user, is_read),
                FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        return '<h1>✅ Tabel notifications berhasil dibuat!</h1><p>Fitur notifikasi penolakan artikel sekarang aktif.</p>';
        
    } catch (Exception $e) {
        return '<h1>❌ Error</h1><p>' . $e->getMessage() . '</p>';
    }
});

