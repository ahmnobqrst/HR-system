<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class MonthlyReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected array $data, protected string $pdfPath) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'تقريرك الشهري - ' . $this->data['month']);
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.monthly_report',
            with: $this->data
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromStorage($this->pdfPath)
                      ->as('تقرير_شهري.pdf')
                      ->withMime('application/pdf'),
        ];
    }
}