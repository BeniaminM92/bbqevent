<?php
namespace App\Controller;

use App\Form\LocationType;
use App\Model\Location;
use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//#[Route('/event')]
class LocationController extends AbstractController{
    #[Route('/location', name: 'app_location_location')]
    public function index(LocationRepository $locationRepository) : Response
    {

        return $this->render('location/home.html.twig',  ['locations' => $locationRepository->findAll()]);

    }


    #[Route('/location/show/{id}', name: 'app_location_show')]
    public function show(int $id, LocationRepository $locationRepository): Response
    {
        $location = $locationRepository->findOne($id);

        if($location){
            return $this->render('location/show.html.twig', [
                'location' => $location,
            ]);
        }else{
            return new Response('No Location Found');
        }


    }

    #[Route('/location/new', name: 'app_location_new')]
    public function create(Request $request, LocationRepository $locationRepository): Response
    {
        $location = new Location(0, '', '', '', null);
        $form = $this->createForm(LocationType::class, $location);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newId = count($locationRepository->findAll()) + 1; // Generate ID
            $location->id = $newId;
            $locationRepository->add($location);

            return $this->redirectToRoute('app_location_location');
        }

        return $this->render('location/new.html.twig', [
            'form' => $form->createView(),
            'location' => $location,
        ]);
    }

    #[Route('/location/{id}/edit', name: 'app_location_edit')]
    public function edit(int $id, Request $request, LocationRepository $locationRepository): Response
    {
        $location = $locationRepository->findOne($id);
        if (!$location) {
            return new Response('Location not found', Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Updated in-place, no need to explicitly persist
            return $this->redirectToRoute('app_location_location');
        }

        return $this->render('location/edit.html.twig', [
            'form' => $form->createView(),
            'location' => $location,
        ]);
    }

    #[Route('/location/{id}/delete', name: 'app_location_delete', methods: ['POST'])]
    public function delete(int $id, Request $request, LocationRepository $locationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $locationRepository->delete($id);
        }

        return $this->redirectToRoute('app_location_location');
    }




//    #[Route('/event/{id}/edit', name: 'app_event_edit')]
//    public function edit(int $id, EventRepository $eventRepository): Response
//    {
//            return new Response('');
//    }
//    #[Route('/event/{id}/delete', name: 'app_event_delete')]
//    public function delete(int $id, EventRepository $eventRepository): Response
//    {
//        return new Response('');
//    }




}
