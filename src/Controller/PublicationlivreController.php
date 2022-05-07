<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicationlivreController extends AbstractController
{
    #[Route('/publicationlivre', name: 'app_publicationlivre')]
    public function index(): Response
    {
        return $this->render('publicationlivre/index.html.twig', [
            'controller_name' => 'PublicationlivreController',
        ]);
    }
}
