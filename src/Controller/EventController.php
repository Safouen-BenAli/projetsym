<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventSearchType;
use App\Form\Event1Type;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/event')]
final class EventController extends AbstractController{
    #[Route(name: 'app_event_index', methods: ['GET'])]
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }


    #[Route('/{id}', name: 'app_event_show', methods: ['GET'])]
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
            'sponsors' => $event->getSponsors(), 
        ]);
    }

    #[Route('/list', name: 'app_event_list', methods: ['GET', 'POST'])]
    public function listEvents(Request $request, EntityManagerInterface $em): Response
    {
        // Créer le formulaire de recherche
        $form = $this->createForm(EventSearchType::class);
        $form->handleRequest($request);

        // Par défaut, tous les événements
        $events = [];

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer le terme de recherche
            $query = $form->get('query')->getData();

            // Utiliser QueryBuilder pour filtrer les événements
            $qb = $em->createQueryBuilder();
            $qb->select('e')
                ->from(Event::class, 'e')
                ->where('e.nomEV LIKE :query OR e.lieuEV LIKE :query')
                ->setParameter('query', '%' . $query . '%')
                ->orderBy('e.dateEV', 'ASC');

            $events = $qb->getQuery()->getResult();
        } else {
            // Afficher tous les événements par défaut
            $events = $em->getRepository(Event::class)->findBy([], ['dateEV' => 'ASC']);
        }

        // Rendre le template avec les résultats
        return $this->render('event/list.html.twig', [
            'searchForm' => $form->createView(),
            'events' => $events,
        ]);
    }
    #[Route('/{map}', name: 'app_event_newMap', methods: ['GET'])]
    public function mapAction()
        {
            return $this->render('GestGestionBundle:Default:newMap.html.twig');
        }
}
