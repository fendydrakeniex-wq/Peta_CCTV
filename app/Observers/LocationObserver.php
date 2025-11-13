<?php

namespace App\Observers;

use App\Models\Location;
use App\Helpers\ActivityLogger;

class LocationObserver
{
    public function created(Location $location): void
    {
        ActivityLogger::log('CREATE', 'LOCATION', $location->id, "Menambahkan lokasi: {$location->name}");
    }

    public function updated(Location $location): void
    {
        $changes = collect($location->getChanges())->except(['updated_at']);
        $desc = "Mengubah lokasi: {$location->name}. Perubahan: " . $changes->toJson();
        ActivityLogger::log('UPDATE', 'LOCATION', $location->id, $desc);
    }

    public function deleting(Location $location): void
    {
        // Catat semua CCTV yang ikut terhapus
        foreach ($location->cctvs as $cctv) {
            ActivityLogger::log('DELETE', 'CCTV', $cctv->id, "CCTV {$cctv->name} ikut terhapus karena lokasi {$location->name} dihapus");
        }
    }

    public function deleted(Location $location): void
    {
        ActivityLogger::log('DELETE', 'LOCATION', $location->id, "Menghapus lokasi: {$location->name}");
    }
}
