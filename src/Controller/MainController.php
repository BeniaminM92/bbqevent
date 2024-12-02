<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/')]
    public function letsgo(): Response
    {
        $party1 = ['name'=>'Techno', 'seats'=> 100]; # Fuer die Techno Party sind noch 100 Plätze frei
        $party2 = ['name'=>'Rock', 'seats'=> 10]; # Achtung fuer die Rock Party sind nur noch 10 Plätze frei
        $party3 = ['name'=>'Hip Hop', 'seats'=> 0]; # Die Hip Hop Party Ausverkauft!

        $partys = [$party1, $party2, $party3];

        $daten = ['name'=>'Hip Hop Party' , 'partys'=>$partys];

        return $this->render('main/letsgo.html.twig', $daten);
//        return $this->render('main/letsgo.html.twig', ['name'=>'Hip Hop Party']);
    }

    #[Route('/show/{slug}')]
    public function show(string $slug = null) : Response
    {
        if($slug) {
//            $slug = str_replace("_", " ", $slug);
//            $slug = ucwords($slug);
            $title = ucwords(str_replace('_', ' ', $slug));
            return new Response("zeige uns $title");

        } else {
            return new Response("zeige uns alle Partys!");
        }
    }
}