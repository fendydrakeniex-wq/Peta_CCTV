<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * ====================================================
     *  PENGATURAN MODEL
     * ====================================================
     */

    // Kolom yang bisa diisi massal
    protected $fillable = ['name', 'lat', 'lon'];

    // Nonaktifkan timestamps karena tabel tidak memiliki created_at / updated_at
    public $timestamps = false;

    /**
     * ====================================================
     *  RELASI DENGAN MODEL LAIN
     * ====================================================
     */

    // Satu lokasi memiliki banyak CCTV
    public function cctvs()
    {
        return $this->hasMany(Cctv::class, 'location_id', 'id');
    }

    /**
     * ====================================================
     *  FUNGSI TAMBAHAN (OPSIONAL)
     * ====================================================
     */

    // Mendapatkan jumlah CCTV di lokasi ini
    public function getCctvCountAttribute()
    {
        return $this->cctvs()->count();
    }

    // Mendapatkan koordinat dalam format array
    public function getCoordinatesAttribute()
    {
        return [$this->lat, $this->lon];
    }

    // Cek apakah lokasi valid (punya koordinat)
    public function getIsValidAttribute()
    {
        return is_numeric($this->lat) && is_numeric($this->lon);
    }
}
