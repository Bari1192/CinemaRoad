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
    public function build()
    {
        return $this->subject('CinemaRoad - Foglalásod törlésre került.')
            ->view('emails.reservation_cancellation')
            ->with([
                'reservation' => $this->reservation,
                'user' => $this->reservation->user->name ?? null,
                'ticket_code' => $this->reservation->confirmation  ?? null,
                'location_name' => $this->reservation->location->name  ?? null,
                'screening_start_time' => $this->reservation->screening->start_time  ?? null,
                'movie_title' => $this->reservation->screening->movie->title  ?? null,
                'parkingspot' => $this->reservation->parkingspot  ?? null,
                'reserved_at' => $this->reservation->reserved_at  ?? null,
            ]);
    }
    public function attachments(): array
    {
        return [];
    }
}
