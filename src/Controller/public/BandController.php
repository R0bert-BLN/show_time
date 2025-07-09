<?php

namespace App\Controller\public;

use App\Entity\Band;
use App\Repository\BandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BandController extends AbstractController
{
    #[Route('/band', name: 'app_band')]
    public function index(BandRepository $bandRepository): Response
    {
        return $this->render('public/band/index.html.twig', [
            'bands' => $bandRepository->findAll(),
        ]);
    }

    #[Route('/band/show/{id}', name: 'app_band_show')]
    public function show(Band $band): Response
    {
        return $this->render('public/band/show.html.twig', [
            'band' => $band,
        ]);
    }
}
