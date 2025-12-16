<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'excerpt',
        'gambar',
        'status',
        'views'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk artikel published
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    // Scope untuk artikel terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Accessor untuk excerpt otomatis
    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }
        return substr(strip_tags($this->konten), 0, 150) . '...';
    }

    // Increment views
    public function incrementViews()
    {
        $this->increment('views');
    }
    
    // Accessor untuk status text
    public function getStatusTextAttribute()
    {
        return $this->status == 1 ? 'Published' : 'Draft';
    }
    
    // Accessor untuk status string
    public function getStatusStringAttribute()
    {
        return $this->status == 1 ? 'published' : 'draft';
    }
}