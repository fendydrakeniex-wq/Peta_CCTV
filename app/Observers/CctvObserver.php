<?php

namespace App\Observers;

use App\Models\Cctv;
use App\Helpers\ActivityLogger;

class CctvObserver
{
    public function created(Cctv $cctv): void
    {
        ActivityLogger::log('CREATE', 'CCTV', $cctv->id, "Menambahkan CCTV: {$cctv->name}");
    }

    public function updated(Cctv $cctv): void
    {
        $changes = collect($cctv->getChanges())->except(['updated_at']);
        $desc = "Mengubah CCTV: {$cctv->name}. Perubahan: " . $changes->toJson();
        ActivityLogger::log('UPDATE', 'CCTV', $cctv->id, $desc);
    }

    public function deleted(Cctv $cctv): void
    {
        ActivityLogger::log('DELETE', 'CCTV', $cctv->id, "Menghapus CCTV: {$cctv->name}");
    }
}
