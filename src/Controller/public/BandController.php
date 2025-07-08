<?php

namespace App\Controller\public;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BandController extends AbstractController
{
    #[Route('/band', name: 'app_band')]
    public function index(): Response
    {
        return $this->render('public/band/index.html.twig', [
            'controller_name' => 'BandController',
        ]);
    }
}
