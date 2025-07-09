<?php

namespace App\Controller\public;

use App\Entity\Festival;
use App\Repository\FestivalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FestivalController extends AbstractController
{
    #[Route('/festival', name: 'app_festival')]
    public function index(FestivalRepository $festivalRepository): Response
    {
        return $this->render('public/festival/index.html.twig', [
            'festivals' => $festivalRepository->findAll(),
        ]);
    }

    #[Route('/festival/show/{id}', name: 'app_festival_show', methods: ['GET'])]
    public function show(Festival $festival): Response
    {
        return $this->render('public/festival/show.html.twig', [
            'festival' => $festival
        ]);
    }
}
