<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
//    #[Route('/', name: 'app_main_letsgo')]
//    public function letsgo(EventRepository $eventRepository): Response
//    {
//
//        $daten = ['name'=>'Hip Hop Event' , 'events'=>$eventRepository->findAll()];
//        return $this->render('main/letsgo.html.twig', $daten);
//    }

    #[Route('/', name: 'app_main_landingPage')]
    public function landingPage(): Response
    {
        // Erzeugung eines dymisches Titels wird übergeben
        return $this->render('main/landingPage.html.twig', [
            'pageTitle' => 'BBQ EventManagement',
            'pageHeadline'=> 'Willkommen beim BBQ Event Management!']);
    }

}