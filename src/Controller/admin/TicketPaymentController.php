<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TicketPaymentController extends AbstractController
{
    #[Route('/admin/ticket/payment', name: 'app_admin_ticket_payment')]
    public function index(): Response
    {
        return $this->render('admin/ticket_payment/index.html.twig', [
        ]);
    }
}
