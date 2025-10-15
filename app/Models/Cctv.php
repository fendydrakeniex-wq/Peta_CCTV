<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cctv extends Model
{
    use HasFactory;

    /**
     * ====================================================
     *  PENGATURAN MODEL
     * ====================================================
     */

    // Kolom yang dapat diisi massal (mass assignable)
    protected $fillable = [
        'location_id',
        'name',
        'url',
    ];

    // Nonaktifkan timestamps (karena tabel kamu tidak punya created_at / updated_at)
    public $timestamps = false;

    /**
     * ====================================================
     *  RELASI DENGAN TABEL LAIN
     * ====================================================
     */

    // Setiap CCTV dimiliki oleh satu lokasi
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    /**
     * ====================================================
     *  FUNGSI TAMBAHAN (OPSIONAL)
     * ====================================================
     */

    // Dapatkan URL video streaming dengan fallback
    public function getStreamUrlAttribute()
    {
        return $this->url ?: '#';
    }

    // Menampilkan label ringkas (menggunakan null-safe operator agar tidak error)
    public function getLabelAttribute()
    {
        $locationName = $this->location?->name ?? 'Tidak diketahui';
        return "{$this->name} ({$locationName})";
    }
}
