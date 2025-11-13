<?php

namespace App\Helpers;

use App\Models\HistoryLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log($action, $model, $modelId = null, $description = null)
    {
        $user = Auth::user();

        $action = strtoupper($action);
        $model = strtoupper($model);

        $prefix = $user ? "{$user->name} melakukan {$action}: " : '';
        $description = $prefix . ($description ?? '');

        HistoryLog::create([
            'action' => $action,
            'model' => $model,
            'model_id' => $modelId,
            'description' => $description,
            'user_id' => $user?->id,
        ]);
    }
}
