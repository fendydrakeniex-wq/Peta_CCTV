<?php

namespace App\Observers;

use App\Models\User;
use App\Helpers\ActivityLogger;

class UserObserver
{
    public function created(User $user): void
    {
        ActivityLogger::log('CREATE', 'USER', $user->id, "Menambahkan user: {$user->name}");
    }

    public function updated(User $user): void
    {
        $changes = collect($user->getChanges())->except(['updated_at']);
        $desc = "Mengubah user: {$user->name}. Perubahan: " . $changes->toJson();
        ActivityLogger::log('UPDATE', 'USER', $user->id, $desc);
    }

    public function deleted(User $user): void
    {
        ActivityLogger::log('DELETE', 'USER', $user->id, "Menghapus user: {$user->name}");
    }
}
