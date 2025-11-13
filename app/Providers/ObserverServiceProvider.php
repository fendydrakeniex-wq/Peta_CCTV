<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Location;
use App\Models\Cctv;
use App\Observers\UserObserver;
use App\Observers\LocationObserver;
use App\Observers\CctvObserver;

class ObserverServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Location::observe(LocationObserver::class);
        Cctv::observe(CctvObserver::class);
    }
}
