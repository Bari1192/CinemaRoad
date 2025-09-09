<?php

namespace App\Mail;

use App\Models\Purchase;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationCancellation extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('CinemaRoad - Foglalás sikeres törlése')
            ->view('emails.reservation_cancellation')
            ->with([
                'reservation' => $this->reservation,
                'user' => $this->reservation->user ?? null,
                'ticket_code' => $this->reservation->confirmation,
            ]);
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
