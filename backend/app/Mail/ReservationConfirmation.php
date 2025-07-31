<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

     public function build()
    {
        return $this->subject('Foglalás megerősítve')
                    ->view('emails.reservation_confirmation')
                    ->with([
                        'reservation' => $this->reservation,
                        'user' => $this->reservation->user,
                    ]);
    }

    public function attachments(): array
    {
        return [];
    }
}
