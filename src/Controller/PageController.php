<?php

namespace App\Controller;

use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('home/page', name: 'app_page')]
    public function index(LivreRepository $livreRepository): Response
    {
        return $this->render('page/page.html.twig', [
            'controller_name' => 'PageController',
            'livrepublics' => $livreRepository->findByExampleField()
        ]);
    }
}
