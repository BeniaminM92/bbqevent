<?php

namespace App\Controller;
use App\Model\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main_letsgo')]
    public function letsgo(EventRepository $eventRepository): Response
    {
//        $party1 = ['name'=>'Techno', 'seats'=> 100]; # Fuer die Techno Event sind noch 100 Plätze frei
//        $party2 = ['name'=>'Rock', 'seats'=> 10]; # Achtung fuer die Rock Event sind nur noch 10 Plätze frei
//        $party3 = ['name'=>'Hip Hop', 'seats'=> 0]; # Die Hip Hop Event Ausverkauft!
//        $partys = [$party1, $party2, $party3];
//        $daten = ['name'=>'Hip Hop Event' , 'partys'=>$partys];

        $daten = ['name'=>'Hip Hop Event' , 'events'=>$eventRepository->findAll()];
        return $this->render('main/letsgo.html.twig', $daten);
    }

    #[Route('/show/{id}', name: 'app_main_show')]
    public function show(string $id = null, EventRepository $eventRepository): Response
    {

        $event = $eventRepository->find($id);

        if($event){
            return $this->render('main/show.html.twig', ['event'=>$event]);
        } else {
            return new Response('Party gibt es nicht!');
        }
    }
}