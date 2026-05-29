<?php

namespace App\Mail;

use App\Models\Courier;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Courier $order) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ [CourierXpress] Đặt đơn thành công - Mã: ' . $this->order->tracking_id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-created',
            with: ['order' => $this->order],
        );
    }
}
