<?php

namespace App\Controller;

use App\Entity\MotosPanier;
use App\Entity\Panier;
use App\Repository\MotosPanierRepository;
use App\Repository\MotosRepository;
use App\Repository\PanierRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default' , methods: ['GET'] )]
    public function index(MotosRepository $motosRepository): Response
    {
        return $this->render('default/index.html.twig', [
            'motos' => $motosRepository->findAll(),
        ]);
       
    }
    #[Route('/motoDetails', name: 'app_motoDetails' , methods: ['GET'] )]
    public function motoDetails(MotosRepository $motosRepository,$id): Response
    {
        return $this->render('defaut/motoDetails.html.twig', [
            'motos' => $motosRepository->findOneBy(array("id"=>$id)),
        ]);
    }

    #[Route('/ajaxAddPanier', name: 'app_ajaxAddPanier' , methods: ['POST'] )]
    public function ajaxAddPanier(Request $request, MotosRepository $motosRepository, PanierRepository $panierRepo, MotosPanierRepository $motosPanierRepo): Response
    {
        $idMoto = $_POST['id'];
        $moto = $motosRepository->findOneById($idMoto);
        $qte = $_POST['quantite'];
        $prixUnit = $moto->getPrice();
        $total = $qte*$prixUnit;

        $panierUser = $panierRepo->findOneBy(['User'=>$this->getUser()]);
        $panier = null;
        // Je vérifie si le user a déjà un panier
        if(empty($panierUser))
        {
            $panier = new Panier();
            $panier->setUser($this->getUser());
            $panier->setPDate(new DateTime());
            $panier->setTotalPrice(0);
            $panierRepo->save($panier, true);
        }
        else
        {
           $panier = $panierUser;
        }

        // J'ajoute le produit dans le panier

        // je verifie si le produit existe deja dans le panier
        // Si oui je mets a jour la qte sinon je l'ajoute

        $motosPanier = $motosPanierRepo->findOneBy(['Motos'=>$idMoto,'Panier'=>$panier]);

        if(!empty($motosPanier))
        {
            $qteExist = $motosPanier->getQuntity();
            $newQte = $qte+$qteExist;
            $sousTotal = $newQte*$prixUnit;

            $motosPanier->setQuntity($newQte);
            $motosPanier->setTotalPrice($sousTotal);

            $motosPanierRepo->save($motosPanier, true);
        }
        else
        { 
            $produit = new MotosPanier();
            $produit->setMotos($moto);
            
            $produit->setQuntity($qte);
            $produit->setTotalPrice($total);
            $motosPanierRepo->save($produit, true);
            $produit->setPanier($panier);
            $motosPanierRepo->save($produit, true);
        }

        // je mets a jour le total du panier

        $motosPaniers = $motosPanierRepo->findBy(['Panier'=>$panier]);

        $sum = 0;

        foreach($motosPaniers as $res)
        {
            $sum = $sum + $res->getTotalPrice();
        }

        $panier->setTotalPrice($sum);
        $panierRepo->save($panier, true);

        $message = 'Le produit a bien été ajouté au panier ' ;

        return new Response($message);
        

    }


    #[Route('/ajaxRecapPanierHeader', name: 'app_ajaxRecapPanierHeader' , methods: ['POST'] )]

    public function ajaxRecapPanierHeader(Request $request, MotosRepository $motosRepository, PanierRepository $panierRepo, MotosPanierRepository $motosPanierRepo): Response
    {
        $panierUser = $panierRepo->findOneBy(['User'=>$this->getUser()]);
     
        
        if(!empty($panierUser))
        {
            //$motosPanier = $motosPanierRepo->findBy(['Panier' => $panierUser]);
            $qte = 0;
            foreach($panierUser->getMotosPaniers() as $moto)
            {
              
                $qte = $qte+$moto->getQuntity();
                
            }
            
          
            
            $total = $panierUser->getTotalPrice();
        }
        else
        {
            $qte = 0;
            $total = 0;
        }
        $chaine = 'Panier('.$qte.') : ';
        $chaine .= $total;
        $chaine .= '€';

        return new Response($chaine);
    }

    
}