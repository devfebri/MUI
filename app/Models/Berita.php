<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Berita extends Model
{
    /** @var array<string> */
    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'kategori',
        'isi',
        'gambar',
        'status',
        'views',
        'published_at',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'views' => 'integer',
        'published_at' => 'datetime',
    ];

    /* ── Relationships ─────────────────────────────── */

    public function penulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /* ── Accessors / Mutators ──────────────────────── */

    /**
     * Auto-generate slug from judul when setting judul.
     */
    public function setJudulAttribute(string $value): void
    {
        $this->attributes['judul'] = $value;
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    /**
     * URL publik untuk gambar berita menggunakan asset().
     */
    public function getGambarUrlAttribute(): ?string
    {
        return $this->gambar ? asset('uploads/berita/'.basename($this->gambar)) : null;
    }
}
