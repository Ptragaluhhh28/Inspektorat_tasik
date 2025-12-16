<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakMasuk extends Model
{
    use HasFactory;

    protected $table = 'kontak_masuk';

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'subjek',
        'pesan',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk status baru
    public function scopeBaru($query)
    {
        return $query->where('status', 'baru');
    }

    // Scope untuk status dibaca
    public function scopeDibaca($query)
    {
        return $query->where('status', 'dibaca');
    }
}