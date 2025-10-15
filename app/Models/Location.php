<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi massal
    protected $fillable = ['name', 'lat', 'lon'];

    // Nonaktifkan timestamps karena tabelmu tidak memiliki created_at / updated_at
    public $timestamps = false;

    // Relasi: 1 lokasi memiliki banyak CCTV
    public function cctvs()
    {
        return $this->hasMany(Cctv::class);
    }
}
