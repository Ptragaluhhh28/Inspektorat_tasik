<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontak';

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'subjek',
        'pesan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk pesan baru/unread
    public function scopeUnread($query)
    {
        return $query->where('status', 0);
    }

    // Scope untuk pesan sudah dibaca
    public function scopeRead($query)
    {
        return $query->where('status', 1);
    }

    // Check if message is new/unread
    public function isUnread()
    {
        return $this->status == 0;
    }

    // Check if message is read
    public function isRead()
    {
        return $this->status == 1;
    }

    // Get status badge class
    public function getStatusBadgeClass()
    {
        return $this->status == 0 ? 'danger' : 'success';
    }

    // Get status label
    public function getStatusLabel()
    {
        return $this->status == 0 ? 'Baru' : 'Dibaca';
    }
}