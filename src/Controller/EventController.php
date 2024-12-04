<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/', name: 'app_event_index')]
    public function index(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();

        return $this->render('event/index.html.twig', [
            'pageTitle' => 'Event Übersicht',
            'pageHeadline' => 'Alle verfügbaren Events',
            'events' => $events,
        ]);
    }

    #[Route('/show/{id}', name: 'app_event_show')]
    public function show(string $id = null, EventRepository $eventRepository): Response
    {
        $event = $eventRepository->find($id);

        if ($event) {
            return $this->render('main/show.html.twig', [
                'pageTitle' => $event->getName(),
                'pageHeadline' => 'Details for ' . $event->getName(),
                'event' => $event,
            ]);
        } else {
            return new Response('Party gibt es nicht!');
        }
    }

    #[Route('/edit/{id}', name: 'app_event_edit')]
    public function edit(string $id, EventRepository $eventRepository): Response
    {
        $event = $eventRepository->find($id);

        if (!$event) {
            return new Response('Event not found!', 404);
        }

        // Render edit form with current event details
        return $this->render('event/edit.html.twig', [
            'pageTitle' => 'Bearbeiten: ' . $event->getName(),
            'pageHeadline' => 'Bearbeiten: ' . $event->getName(),
            'event' => $event,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_event_delete')]
    public function delete(string $id, EventRepository $eventRepository): Response
    {
        $event = $eventRepository->find($id);

        if (!$event) {
            return new Response('Event not found!', 404);
        }
        // Simulate deletion by filtering out the event from the repository
        $allEvents = $eventRepository->findAll();
        $updatedEvents = array_filter($allEvents, fn($e) => $e->getId() !== (int) $id);

        // Return to the events index page after deletion
        return $this->redirectToRoute('app_event_index');
    }

}