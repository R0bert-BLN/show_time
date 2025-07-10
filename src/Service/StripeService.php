<?php

namespace App\Service;

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class StripeService
{
    public function __construct(private RouterInterface $router)
    {
        Stripe::setApiKey('sk_test_51RjOUqCK5cMFxUB5XHZy9sqTtvl8aRDKdndhvkk0XhZeNeWT0qqzA7ZfWTrVx2ccJk5QY4XR9GToumZ5QvSF8MgI0010YLfWuK');
    }

    public function createCheckoutSession(array $cart): Session
    {
        $items = [];

        foreach ($cart as $item) {
            $items[] = [
                'price_data' => [
                    'currency' => 'ron',
                    'product_data' => [
                        'name' => $item['ticketType']->getName(),
                    ],
                    'unit_amount' => (int)(($item['ticketType']->getPrice()) * 100),
                ],
                'quantity' => $item['quantity'],
            ];
        }

        return Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $items,
            'mode' => 'payment',
            'success_url' => $this->router->generate('app_checkout_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->router->generate('app_checkout_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
    }
}
