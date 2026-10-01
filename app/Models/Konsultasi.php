<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Konsultasi extends Model
{
    /** @var array<string> */
    protected $fillable = [
        'nama',
        'email',
        'usia',
        'jenis_kelamin',
        'kab_kota',
        'kategori',
        'pertanyaan',
        'status',
        'jawaban',
        'penjawab_id',
        'answered_at',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'usia' => 'integer',
        'answered_at' => 'datetime',
    ];

    public function penjawab(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penjawab_id');
    }
}
