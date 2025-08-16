<?php

namespace App\Mail;

use App\Models\Reservation;
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
        return $this->subject('CinemaRoad - Foglalásod megerősítve')
            ->view('emails.reservation_confirmation')
            ->with([
                'reservation' => $this->reservation,
                'user' => $this->reservation->user,
                'location' => $this->reservation->location->name ?? 'Ismeretlen helyszín',
                'confirmation' => $this->reservation->confirmation,
                'ticket_code' => $this->reservation->confirmation, // IDE
                'screening_start_time' => $this->reservation->screening->start_time ?? 'Ismeretlen időpont',
                'movie_name' => $this->reservation->screening->movie->title ?? 'Ismeretlen film',
                'parking_spot' => $this->reservation->parkingspot,
            ]);
    }

    public function attachments(): array
    {
        return [];
    }
}
