<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService
{
    public function __construct(private MailerInterface $mailer) {}

    public function sendBookingConfirmationEmail(string $to, string $pdfPath): void
    {
        $email = (new Email())
            ->from('no-reply@example.com')
            ->to($to)
            ->subject('Your Tickets')
            ->text('Thank you for your purchase! Please find your tickets attached.')
            ->attachFromPath($pdfPath, 'tickets.pdf', 'application/pdf');

        $this->mailer->send($email);
    }
}
