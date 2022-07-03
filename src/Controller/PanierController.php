<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class PanierController extends AbstractController
{
    #[Route("/front/description.html.twig/{id}" , name:"description_article")]
   
    public function show(Vehicule $vehicule): Response {
        return $this->render("/front/Description.html.twig" , ["vehicule" => $vehicule]);
    }

    #[Route("/panier" , name:"panier_index")]
    public function index(SessionInterface $session, VehiculeRepository $vehiculeRepository){
        $panier = $session->get('panier', []);

        $panierwithData = [];

        foreach($panier as $id => $quantity){
            $panierwithData[] = [
                'vehicule' => $vehiculeRepository->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach($panierwithData as $item) {
            $totalItem = $item['vehicule']->getPrix() * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('panier/panier.html.twig', [
            'items' => $panierwithData,
            'total' => $total
        ]);
    }




    #[Route("/panier/add/{id}" , name:"panier_add")]
    public function add($id, SessionInterface $session) {
        
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {

           $panier[$id]++;
        } else {
        $panier[$id] = 1;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("panier_index");
    }

    #[Route("/panier/remove/{id}" , name:"panier_remove")]
    public function remove($id, SessionInterface $session) {
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("panier_index");
    }

    
}