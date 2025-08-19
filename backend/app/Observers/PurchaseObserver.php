<?php

namespace App\Observers;

use App\Mail\PurchaseConfirmation;
use App\Mail\ReservationConfirmation;
use App\Models\Purchase;
use Illuminate\Support\Facades\Mail;

class PurchaseObserver
{
    public function created(Purchase $purchase)
    {
        if ($purchase->guest_email && $purchase->guest_email != null) {
            Mail::to($purchase->guest_email)->send(
                new PurchaseConfirmation($purchase)
            );
        } elseif ($purchase->user && $purchase->user->email) {
            Mail::to($purchase->user->email)->send(
                new PurchaseConfirmation($purchase)
            );
        }
    }

    public function updated(Purchase $purchase): void
    {
        //
    }

    public function deleted(Purchase $purchase): void
    {
        //
    }

    public function restored(Purchase $purchase): void
    {
        //
    }

    public function forceDeleted(Purchase $purchase): void
    {
        //
    }
}
