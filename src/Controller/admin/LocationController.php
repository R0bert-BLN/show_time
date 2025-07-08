<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LocationController extends AbstractController
{
    #[Route('/admin/location', name: 'app_admin_location')]
    public function index(): Response
    {
        return $this->render('controller/admin/location/index.html.twig', [
            'controller_name' => 'LocationController',
        ]);
    }
}
