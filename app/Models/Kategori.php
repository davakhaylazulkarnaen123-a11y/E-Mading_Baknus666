<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kategori';
    public $incrementing = true;
    
    public function getRouteKeyName()
    {
        return 'id_kategori';
    }

    protected $fillable = [
        'nama_kategori',
    ];

    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'id_kategori');
    }
}