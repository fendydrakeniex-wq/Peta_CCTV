<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'model',
        'model_id',
        'description',
        'user_id',
    ];

    public $timestamps = true; // ✅ aktifkan timestamp

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
