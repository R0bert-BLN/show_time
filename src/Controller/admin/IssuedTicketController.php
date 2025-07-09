<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IssuedTicketController extends AbstractController
{
    #[Route('/admin/issued/ticket', name: 'app_admin_issued_ticket')]
    public function index(): Response
    {
        return $this->render('admin/issued_ticket/index.html.twig', [
        ]);
    }
}
