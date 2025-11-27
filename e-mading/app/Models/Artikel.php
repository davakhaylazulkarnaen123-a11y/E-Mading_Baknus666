<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_artikel';
    public $incrementing = true;
    
    public function getRouteKeyName()
    {
        return 'id_artikel';
    }

    protected $fillable = [
        'judul',
        'isi', 
        'tanggal',
        'id_user',
        'id_kategori',
        'foto',
        'foto_thumbnail',
        'foto_medium',
        'foto_webp',
        'status',
        'views',
        'tags',
        'scheduled_at',
        'rejection_reason',
        'reviewed_at',
        'reviewed_by',
    ];
    protected $attributes = [
        'views' => 0,
        'status' => 'draft',
    ];
    
    // Status constants
    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';
    const STATUS_PUBLISHED = 'published';
    const STATUS_REJECTED = 'rejected';
    
    public static function getStatusOptions()
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PENDING => 'Menunggu Review',
            self::STATUS_PUBLISHED => 'Dipublikasikan',
            self::STATUS_REJECTED => 'Ditolak'
        ];
    }
    
    public function getStatusLabelAttribute()
    {
        return self::getStatusOptions()[$this->status] ?? 'Unknown';
    }
    
    public function isDraft()
    {
        return $this->status === self::STATUS_DRAFT;
    }
    
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }
    
    public function isPublished()
    {
        return $this->status === self::STATUS_PUBLISHED;
    }
    
    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    protected $casts = [
        'tanggal' => 'date',
        'scheduled_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_artikel');
    }

    public function getLikeCountAttribute()
    {
        return $this->likes()->count();
    }

    public function isLikedByUser($userId)
    {
        return $this->likes()->where('id_user', $userId)->exists();
    }
    
    public function getImageUrl($size = 'original')
    {
        if (!$this->foto) return null;
        return asset('storage/artikels/' . $this->foto);
    }
    
    public function getThumbnailUrl()
    {
        return $this->getImageUrl('thumbnail');
    }
    
    public function getMediumImageUrl()
    {
        return $this->getImageUrl('medium');
    }
    
    public function getWebpUrl()
    {
        return $this->getImageUrl('webp');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_artikel');
    }
    
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}