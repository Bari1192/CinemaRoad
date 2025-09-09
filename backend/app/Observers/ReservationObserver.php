<?php

namespace App\Observers;

use App\Mail\ReservationCancellation;
use App\Mail\ReservationConfirmation;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;

class ReservationObserver
{
    public function created(Reservation $reservation)
    {
        if ($reservation->user && $reservation->user->email) {
            Mail::to($reservation->user->email)->send(
                new ReservationConfirmation($reservation)
            );
        }
    }

    public function updated(Reservation $reservation): void
    {
        //
    }

    public function deleted(Reservation $reservation): void
    {
        if ($reservation->user && $reservation->user->email) {
            Mail::to($reservation->user->email)->send(
                new ReservationCancellation($reservation)
            );
        }
    }

    public function restored(Reservation $reservation): void
    {
        //
    }

    public function forceDeleted(Reservation $reservation): void
    {
        //
    }
}
