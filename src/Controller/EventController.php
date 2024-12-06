<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\BinaryOp\Equal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            return $this->render('event/show.html.twig', [
                'pageTitle' => $event->getName(),
                'pageHeadline' => 'Details for ' . $event->getName(),
                'event' => $event,
            ]);
        } else {
            return new Response('Party gibt es nicht!');
        }
    }

    #[Route('/edit/{id}', name: 'app_event_edit')]
    public function edit(Event $event, EntityManagerInterface $entityManager): Response
    {
        $event->setName('Techno-Event');
        $entityManager->persist($event);
        $entityManager->flush();

        return $this->redirectToRoute('app_event_show', ['id' => $event->getId()]);
    }

    #[Route('/delete/{id}', name: 'app_event_delete')]
    public function delete(Event $event, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($event);
        $entityManager->flush();
//        dd($location);

        return $this->redirectToRoute('app_location_index');
    }

    #[Route('/new', name: 'app_event_new')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
//        dd($request->query->all());
        $event = new Event();
        $event->setName('Alex')
            ->setDescription('blablabla')
            ->setBookedseats(20);
//        dd($event);
        $entityManager->persist($event);
        $entityManager->flush();
        return new Response('Event erfolgreich erstellt!');
    }

    #[Route('/test', name: 'app_event_test')]
    public function test(Request $request)
    {
        if ($request->isMethod('GET')) {

            return $this->render('post.html.twig');
        } elseif ($request->isMethod('POST')) {
            $var = $request->request->all()['key'];
            return new Response("Machen Sachen $var");
        }

    }

}