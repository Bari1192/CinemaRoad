<?php

namespace App\Mail;

use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $purchase;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function build()
    {
        return $this->subject('CinemaRoad Jegyed - Sikeres vásárlás')
            ->view('emails.purchase_confirmation')
            ->with([
                'purchase' => $this->purchase,
                'user' => $this->purchase->user ?? null,
                'location' => $this->purchase->location->name,
                'ticket_code' => $this->purchase->ticket_code,
                'screening_start_time' => $this->purchase->screening->start_time,
                'movie_name' => $this->purchase->screening->movie->title,
                'parking_spot' => $this->purchase->parkingspot,
            ]);
    }

    public function attachments(): array
    {
        return [];
    }
}
