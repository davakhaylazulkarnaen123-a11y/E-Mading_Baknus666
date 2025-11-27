<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'id_comment';
    
    public function getRouteKeyName()
    {
        return 'id_comment';
    }
    
    protected $fillable = [
        'id_artikel',
        'id_user', 
        'isi_komentar',
        'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean'
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'id_artikel');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}