<?php

namespace App\Service;

use App\Entity\Booking;
use App\Entity\CartHistory;
use App\Entity\IssuedTicket;
use App\Enum\BookingStatus;
use App\Enum\CartStatus;
use App\Enum\IssuedTicketStatus;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;

class BookingService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private BookingRepository $bookingRepository,
//        private QrCodeService $qrCodeService,
//        private MailService $mailService
    ) {}

    public function createPendingBooking(CartHistory $cart, string $paymentIntentId): Booking
    {
        $cart->setStatus(CartStatus::PROCESSING);

        $booking = new Booking();
        $booking->setCart($cart);
        $booking->setTransactionId($paymentIntentId);
        $booking->setStatus(BookingStatus::PENDING);

        $this->entityManager->persist($booking);
        $this->entityManager->flush();

        return $booking;
    }

    public function completeBooking(string $transactionId): ?Booking
    {
        $booking = $this->bookingRepository->findOneBy(['transactionId' => $transactionId]);
//        $qrPaths = [];

        if (!$booking || $booking->getStatus() === BookingStatus::COMPLETED) {
            return null;
        }

        $booking->setStatus(BookingStatus::COMPLETED);
        $booking->getCart()->setStatus(CartStatus::COMPLETED);

        foreach ($booking->getCart()->getCartItems() as $item) {
            for ($i = 0; $i < $item->getQuantity(); $i++) {
                $issuedTicket = new IssuedTicket();
                $issuedTicket->setBooking($booking);
                $issuedTicket->setTicketType($item->getTicketType());
                $issuedTicket->setStatus(IssuedTicketStatus::ACTIVE);

//                $qrData = 'ticket-' . uniqid();
//                $qrPath = $this->qrCodeService->generateQrCode($qrData);
//                $qrPaths[] = $qrPath;

                $issuedTicket->setQrCodeId('ticket-' . uniqid());

                $this->entityManager->persist($issuedTicket);
            }
        }

        $this->entityManager->flush();

//        $pdfPath = $this->qrCodeService->generatePdfWithQrCodes($qrPaths);
//        $this->mailService->sendBookingConfirmationEmail(
//            $booking->getCart()->getUser()->getEmail(),
//            $pdfPath
//        );

        return $booking;
    }
}
