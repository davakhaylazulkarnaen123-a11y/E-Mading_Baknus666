<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('notifications.index', compact('notifications'));
    }
    
    public function markAsRead($id)
    {
        $notification = Notification::where('id_notification', $id)
            ->where('id_user', auth()->id())
            ->firstOrFail();
            
        $notification->update(['is_read' => true]);
        
        return redirect()->back()->with('success', 'Notifikasi ditandai sudah dibaca');
    }
    
    public function markAllAsRead()
    {
        auth()->user()->notifications()
            ->where('is_read', false)
            ->update(['is_read' => true]);
            
        return redirect()->back()->with('success', 'Semua notifikasi ditandai sudah dibaca');
    }
    
    public function destroy($id)
    {
        $notification = Notification::where('id_notification', $id)
            ->where('id_user', auth()->id())
            ->firstOrFail();
            
        $notification->delete();
        
        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus');
    }
}