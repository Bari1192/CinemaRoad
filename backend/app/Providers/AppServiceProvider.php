<?php

namespace App\Providers;

use App\Models\Purchase;
use App\Models\Reservation;
use App\Observers\PurchaseObserver;
use App\Observers\ReservationObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Model::shouldBeStrict();
        Reservation::observe(ReservationObserver::class);
        Purchase::observe(PurchaseObserver::class);
    }
}
