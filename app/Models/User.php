<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';
    public $incrementing = true;
    
    public function getRouteKeyName()
    {
        return 'id_user';
    }

    protected $fillable = [
        'nama',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'id_user');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_user');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isGuru()
    {
        return $this->role === 'guru';
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }
    
    public function hasRole($role)
    {
        return $this->role === $role;
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_user');
    }
    
    public function notifications()
    {
        try {
            if (!\Schema::hasTable('notifications')) {
                return $this->newQuery()->whereRaw('1 = 0');
            }
            return $this->hasMany(Notification::class, 'id_user');
        } catch (Exception $e) {
            return $this->newQuery()->whereRaw('1 = 0');
        }
    }
    
    public function unreadNotifications()
    {
        try {
            if (!\Schema::hasTable('notifications')) {
                return collect();
            }
            return $this->notifications()->where('is_read', false);
        } catch (Exception $e) {
            return collect();
        }
    }
}