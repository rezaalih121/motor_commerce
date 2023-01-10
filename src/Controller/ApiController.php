<?php

namespace App\Controller;
use App\Entity\Motos;
use App\Entity\MotosPanier;
use App\Entity\Panier;
use App\Form\MotosType;
use App\Repository\CmdRepository;
use App\Repository\MarqueRepository;
use App\Repository\MotosRepository;
use App\Repository\PanierRepository;
use App\Repository\PhotosRepository;
use App\Repository\AddressRepository;
use App\Repository\MotosPanierRepository;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
    #[Route('/api/motos', name: 'api_motos_index', methods: ['GET'])]
    public function api_motos(MotosRepository $motosRepository): Response
    {
        $motos = $motosRepository->findAll();
        return $this->json(
            $motos
        );
    }
    #[Route('/api/cmds', name: 'api_cmds_index', methods: ['GET'])]
    public function api_cmds(CmdRepository $cmdRepository): Response
    {
        $motos = $cmdRepository->findAll();
        return $this->json(
            $motos
        );
    }
    #[Route('/api/paniers', name: 'api_paniers_index', methods: ['GET'])]
    public function api_paniers(PanierRepository $panierRepository): Response
    {
        $paniers = $panierRepository->findAll();
        return $this->json(
            $paniers
        );
    }

    #[Route('/api/paniers/{panier}', name: 'api_paniers_by_id', methods: ['GET'])]
    public function api_paniers_by_id(PanierRepository $panierRepository , Panier $panier): Response
    {
        return $this->json(
            $panier
        );
    }


    #[Route('/api/motospaniers', name: 'api_motospaniers_index', methods: ['GET'])]
    public function api_motospaniers(MotosPanierRepository $motosPanierRepository): Response
    {
        $motospaniers = $motosPanierRepository->findAll();
        return $this->json(
            $motospaniers
        );
    }

    #[Route('/api/motospaniers/{motospaniers}', name: 'api_motospaniers_by_id', methods: ['GET'])]
    public function api_motospaniers_by_id(MotosPanierRepository $motosPanierRepository , MotosPanier $motospaniers): Response
    {
        return $this->json(
            $motospaniers
        );
    }

    #[Route('/api/motospaniers/{panier}', name: 'api_motospaniers_by_panier', methods: ['GET'])]
    public function api_motospaniers_by_panier(MotosPanierRepository $motosPanierRepository , PanierRepository $panierRepository , Panier $panier): Response
    {
        $motos = $motosPanierRepository->findBy(['Panier'=>$panier]);
        return $this->json(
            $motos
        );
    }

    #[Route('/api/photos', name: 'api_photos_index', methods: ['GET'])]
    public function api_photos(PhotosRepository $photosRepository): Response
    {
        $motos = $photosRepository->findAll();
        return $this->json(
            $motos
        );
    }

    #[Route('/api/photos/{Id}', name: 'api_photos_by_moto', methods: ['GET'])]
    public function api_photos_by_moto(PhotosRepository $photosRepository, MotosRepository $motosRepository, Request $request): Response
    {
        $routeParams = $request->attributes->get('_route_params');
        $photos = $photosRepository->findBy(['Motos' => $motosRepository->find($routeParams['Id'])]);
        return $this->json(
            $photos
        );
    }

    #[Route('/api/address', name: 'api_address_index', methods: ['GET'])]
    public function api_address(AddressRepository $addressRepository): Response
    {
        $motos = $addressRepository->findAll();
        return $this->json(
            $motos
        );
    }
    #[Route('/api/marques', name: 'api_marques_index', methods: ['GET'])]
    public function api_marques(MarqueRepository $marqueRepository): Response
    {
        $motos = $marqueRepository->findAll();
        return $this->json(
            $motos
        );
    }
}