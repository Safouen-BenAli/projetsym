<?php

namespace App\Controller;

use App\Entity\Sponsor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\EventRepository;
use App\Repository\SponsorRepository;

class EventController extends AbstractController
{
    #[Route('/events', name: 'app_client_events')]
    public function clientEvents(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll(); // Fetch all events
    
        return $this->render('event/index.html.twig', [
            'events' => $events,
        ]);
    }
    
    #[Route('/events/{id}', name: 'app_client_event_detail')]
    public function clientEventDetail(int $id, EventRepository $eventRepository): Response
    {
        $event = $eventRepository->find($id);
    
        if (!$event) {
            throw $this->createNotFoundException('The event does not exist.');
        }
    
        return $this->render('event/event_detail.html.twig', [
            'event' => $event,
            'sponsors' => $event->getSponsors(), // Get sponsors for the event
        ]);
    }
    
}
