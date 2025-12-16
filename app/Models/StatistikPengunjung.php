<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistikPengunjung extends Model
{
    use HasFactory;

    protected $table = 'statistik_pengunjung';

    protected $fillable = [
        'tanggal',
        'jumlah_pengunjung',
        'unique_visitors',
        'page_views'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk bulan ini
    public function scopeBulanIni($query)
    {
        return $query->whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year);
    }

    // Scope untuk 7 hari terakhir
    public function scopeSemingguTerakhir($query)
    {
        return $query->where('tanggal', '>=', now()->subDays(7));
    }
}