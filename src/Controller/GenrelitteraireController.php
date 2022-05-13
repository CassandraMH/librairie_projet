<?php

namespace App\Controller;

use App\Entity\Genrelitteraire;
use App\Form\GenrelitteraireType;
use App\Repository\GenrelitteraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/genrelitteraire')]
class GenrelitteraireController extends AbstractController
{
    #[Route('/', name: 'app_genrelitteraire_index', methods: ['GET'])]
    public function index(GenrelitteraireRepository $genrelitteraireRepository): Response
    {
        return $this->render('genrelitteraire/index.html.twig', [
            'genrelitteraires' => $genrelitteraireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_genrelitteraire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GenrelitteraireRepository $genrelitteraireRepository): Response
    {
        $genrelitteraire = new Genrelitteraire();
        $form = $this->createForm(GenrelitteraireType::class, $genrelitteraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $genrelitteraireRepository->add($genrelitteraire);
            return $this->redirectToRoute('app_genrelitteraire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('genrelitteraire/new.html.twig', [
            'genrelitteraire' => $genrelitteraire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_genrelitteraire_show', methods: ['GET'])]
    public function show(Genrelitteraire $genrelitteraire): Response
    {
        return $this->render('genrelitteraire/show.html.twig', [
            'genrelitteraire' => $genrelitteraire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_genrelitteraire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Genrelitteraire $genrelitteraire, GenrelitteraireRepository $genrelitteraireRepository): Response
    {
        $form = $this->createForm(GenrelitteraireType::class, $genrelitteraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $genrelitteraireRepository->add($genrelitteraire);
            return $this->redirectToRoute('app_genrelitteraire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('genrelitteraire/edit.html.twig', [
            'genrelitteraire' => $genrelitteraire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_genrelitteraire_delete', methods: ['POST'])]
    public function delete(Request $request, Genrelitteraire $genrelitteraire, GenrelitteraireRepository $genrelitteraireRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$genrelitteraire->getId(), $request->request->get('_token'))) {
            $genrelitteraireRepository->remove($genrelitteraire);
        }

        return $this->redirectToRoute('app_genrelitteraire_index', [], Response::HTTP_SEE_OTHER);
    }
}
