<?php

namespace App\Controller\public;

use App\Service\BookingService;
use App\Service\CartHistoryService;
use App\Service\StripeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CheckoutController extends AbstractController
{
    #[Route('/checkout/session/create', name: 'app_checkout_session_create', methods: ['POST'])]
    public function createSession(
        StripeService $stripeService,
        CartHistoryService $cartHistoryService,
        BookingService $bookingService): JsonResponse
    {
        $cartItems = $cartHistoryService->getCartItems($this->getUser());
        $cart = $cartHistoryService->getActiveCart($this->getUser());

        $session = $stripeService->createCheckoutSession($cartItems);
        $bookingService->createPendingBooking($cart, $session->id);
        $bookingService->completeBooking($session->id);

        return new JsonResponse(['id' => $session->id]);
    }

    #[Route('/checkout/success', name: 'app_checkout_success', methods: ['GET'])]
    public function success(BookingService $bookingService): Response
    {
        return $this->render('public/checkout/success.hml.twig');
    }

    #[Route('/checkout/cancel', name: 'app_checkout_cancel', methods: ['GET'])]
    public function cancel(): Response
    {
        return $this->render('public/checkout/cancel.html.twig');
    }
}
