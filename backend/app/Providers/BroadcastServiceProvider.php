<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Foundation\Support\Providers\BroadcastServiceProvider as ServiceProvider;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;

class BroadcastServiceProvider extends SupportServiceProvider
{
    /**
     * Register any broadcasting services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}
