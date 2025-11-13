<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;

class HistoryLogController extends Controller
{
    public function index()
    {
        $logs = HistoryLog::with('user')->latest()->paginate(10);
        return view('history.index', compact('logs'));
    }
}
