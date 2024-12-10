<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationFormType;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/location')]
class LocationController extends AbstractController{
    #[\Symfony\Component\Routing\Attribute\Route('/', name: 'app_location_index')]
    public function index(LocationRepository $locationRepository): Response
    {
        $locations = $locationRepository->findAll();

        return $this->render('location/index.html.twig', [
            'pageTitle' => 'Location Übersicht',
            'pageHeadline' => 'Alle verfügbaren Locations',
            'locations' => $locations,
        ]);
    }

    #[Route('/show/{id}', name: 'app_location_show')]
    public function show(string $id = null, LocationRepository $locationRepository): Response
    {
        $location = $locationRepository->find($id);

        if ($location) {
            return $this->render('location/show.html.twig', [
                'pageTitle' => $location->getName(),
                'pageHeadline' => 'Details for ' . $location->getName(),
                'location' => $location,
            ]);
        } else {
            return new Response('Party gibt es nicht!');
        }
    }
    #[Route('/edit/{id}', name: 'app_location_edit')]
    //TODO: EDIT UEBERARBEITEN!!!
    public function edit(Location $location, EntityManagerInterface $entityManager): Response
    {
        $location->setName('BerlinClub');
        $entityManager->persist($location);
        $entityManager->flush();
//        dd($location);

        return $this->redirectToRoute('app_location_show', ['id' => $location->getId()]);
    }

    #[Route('/delete/{id}', name: 'app_location_delete')]
    public function delete(Location $location, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($location);
        $entityManager->flush();
//        dd($location)n

        return $this->redirectToRoute('app_location_index');
    }

    #[Route('/new', name: 'app_location_new')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $location = new Location();
        $form = $this->createForm(LocationFormType::class, $location, [
            'action' => $this->generateUrl('app_location_new'),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // möglicherweise nicht notwendig da dieser Fall vermutlich bereits in handleRequest übernommen wird
            $location= $form->getData();

            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('app_location_show', ['id' => $location->getId()]);
        } else {
            $form = $this->createForm(LocationFormType::class, $location);


            return $this->render('location/new.html.twig',['form' => $form->createView()]);
        }
    }
}
