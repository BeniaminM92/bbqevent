<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventFormType;
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
    public function show(int $id, EventRepository $eventRepository): Response
    {
        $event = $eventRepository->find($id);

            return $this->render('event/show.html.twig', [
                'pageTitle' => $event->getName(),
                'pageHeadline' => 'Details for ' . $event->getName(),
                'event' => $eventRepository->find($id)]);
    }

    #[Route('/edit/{id}', name: 'app_event_edit')]
    public function edit(Event $event, EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(EventFormType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event = $form->getData();

            $entityManager->persist($event);
            $entityManager->flush();
            return $this->redirectToRoute('app_event_show', ['id' => $event->getId()]);
        }
        return $this->render('event/edit.html.twig', ['form' => $form->createView(), 'pageTitle' => 'Event Übersicht',
            'pageHeadline' => 'Alle verfügbaren Events']);
    }

    #[Route('/delete/{id}', name: 'app_event_delete')]
    public function delete(Event $event, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($event);
        $entityManager->flush();
//        dd($location);

        return $this->redirectToRoute('app_event_index');
    }

    #[Route('/new', name: 'app_event_new')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventFormType::class, $event, [
            'action' => $this->generateUrl('app_event_new'),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // möglicherweise nicht notwendig da dieser Fall vermutlich bereits in handleRequest übernommen wird
            $event= $form->getData();
//            $event->setName($request->request->get('name'))
//                ->setDescription($request->request->get('description'))
//                ->setBookedseats($request->request->get('bookedseats'));
//            dd($event);
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_event_show', ['id' => $event->getId()]);
        } else {

            return $this->render('event/new.html.twig', ['form' => $form->createView(), 'pageTitle' => 'Event Übersicht',
                'pageHeadline' => 'Alle verfügbaren Events']);
        }
    }

    #[Route('/test', name: 'app_event_test')]
    public function test(Request $request)
    {
        return new Response('Ich komme von event/new');

    }


}