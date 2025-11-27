<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_report';
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'jenis',
        'data',
        'id_user'
    ];

    protected $casts = [
        'data' => 'array',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}