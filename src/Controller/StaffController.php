<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StaffController extends AbstractController
{
    #[Route('/admin/staff', name: 'app_admin_staff')]
    public function index(): Response
    {
        return $this->render('admin/staff/index.html.twig', [
            'controller_name' => 'StaffController',
        ]);
    }
}
