<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cctv extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi massal
        protected $fillable = [
            'location_id',
            'name',
            'ip_address',
            'port',
            'username',
            'password',
            'protocol',
            'url',
            'stream_path',
        ];

    // Nonaktifkan timestamps
    public $timestamps = false;

    // Setiap CCTV dimiliki oleh satu lokasi
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    // === FUNGSI TAMBAHAN OPSIONAL ===

    public function getStreamUrlAttribute()
    {
        return $this->url ?: '#';
    }

    public function getLabelAttribute()
    {
        $locationName = $this->location?->name ?? 'Tidak diketahui';
        return "{$this->name} ({$locationName})";
    }
}
