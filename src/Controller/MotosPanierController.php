<?php

namespace App\Controller;

use App\Entity\MotosPanier;
use App\Form\MotosPanierType;
use App\Repository\MotosPanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/motos/panier')]
class MotosPanierController extends AbstractController
{
    #[Route('/', name: 'app_motos_panier_index', methods: ['GET'])]
    public function index(MotosPanierRepository $motosPanierRepository): Response
    {
        return $this->render('motos_panier/index.html.twig', [
            'motos_paniers' => $motosPanierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_motos_panier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MotosPanierRepository $motosPanierRepository): Response
    {
        $motosPanier = new MotosPanier();
        $form = $this->createForm(MotosPanierType::class, $motosPanier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $motosPanierRepository->save($motosPanier, true);

            return $this->redirectToRoute('app_motos_panier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('motos_panier/new.html.twig', [
            'motos_panier' => $motosPanier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_motos_panier_show', methods: ['GET'])]
    public function show(MotosPanier $motosPanier): Response
    {
        return $this->render('motos_panier/show.html.twig', [
            'motos_panier' => $motosPanier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_motos_panier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MotosPanier $motosPanier, MotosPanierRepository $motosPanierRepository): Response
    {
        $form = $this->createForm(MotosPanierType::class, $motosPanier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $motosPanierRepository->save($motosPanier, true);

            return $this->redirectToRoute('app_motos_panier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('motos_panier/edit.html.twig', [
            'motos_panier' => $motosPanier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_motos_panier_delete', methods: ['POST'])]
    public function delete(Request $request, MotosPanier $motosPanier, MotosPanierRepository $motosPanierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$motosPanier->getId(), $request->request->get('_token'))) {
            $motosPanierRepository->remove($motosPanier, true);
        }

        return $this->redirectToRoute('app_motos_panier_index', [], Response::HTTP_SEE_OTHER);
    }
}
