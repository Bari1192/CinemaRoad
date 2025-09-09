<?php

namespace App\Mail;

use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PurchaseCancellation extends Mailable
{
    use Queueable, SerializesModels;

    public $purchase;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('CinemaRoad - Vásárlás sikeres törlése')
            ->view('emails.purchase_cancellation')
            ->with([
                'purchase' => $this->purchase,
                'user' => $this->purchase->user ?? null,
                //'location' => $this->purchase->location->name,
                'ticket_code' => $this->purchase->ticket_code,
                //'screening_start_time' => $this->purchase->screening->start_time,
                //'movie_name' => $this->purchase->screening->movie->title,
                //'parking_spot' => $this->purchase->parkingspot,
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
