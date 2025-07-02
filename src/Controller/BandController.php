<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BandController extends AbstractController
{
    #[Route('/admin/band', name: 'app_admin_band')]
    public function index(): Response
    {
        return $this->render('admin/band/index.html.twig', [
            'controller_name' => 'BandController',
        ]);
    }
}
