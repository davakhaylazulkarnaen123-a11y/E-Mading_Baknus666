<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function toggle(Request $request, Artikel $artikel)
    {
        if (!Auth::check()) {
            return response()->json([
                'error' => 'Anda harus login untuk memberikan like'
            ], 401);
        }
        
        $user = Auth::user();
        
        $existingLike = Like::where('id_artikel', $artikel->id_artikel)
                           ->where('id_user', $user->id_user)
                           ->first();
        
        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            Like::create([
                'id_artikel' => $artikel->id_artikel,
                'id_user' => $user->id_user,
            ]);
            $liked = true;
        }
        
        // Refresh artikel untuk mendapatkan count terbaru
        $artikel->refresh();
        
        return response()->json([
            'liked' => $liked,
            'like_count' => $artikel->likes()->count()
        ]);
    }
}