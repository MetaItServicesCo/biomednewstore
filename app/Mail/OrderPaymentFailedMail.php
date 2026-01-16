<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPaymentFailedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order;
    public $errorMessage;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, string $errorMessage = null)
    {
        $this->order = $order;
        $this->errorMessage = $errorMessage;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Failed - Order #' . $this->order->order_id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order-payment-failed',
            with: [
                'order' => $this->order,
                'items' => $this->order->items,
                'errorMessage' => $this->errorMessage,
            ],
        );
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
