<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\Event1Type;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/event/back')]
final class EventBackController extends AbstractController
{
    #[Route(name: 'app_event_back_index', methods: ['GET', 'POST'])]
    public function index(Request $request, EventRepository $eventRepository, PaginatorInterface $paginator): Response
    {
        // Retrieve the search term from the query parameters
        $searchTerm = $request->query->get('search', '');

        // Create the query builder for filtering events
        $queryBuilder = $eventRepository->createQueryBuilder('e');
        
        if ($searchTerm) {
            $queryBuilder
                ->where('e.nomEV LIKE :search')
                ->orWhere('e.lieuEV LIKE :search')
                ->orWhere('e.dateEV LIKE :search')
                ->setParameter('search', '%' . $searchTerm . '%');
        }

        // Paginate the results
        $pagination = $paginator->paginate(
            $queryBuilder, // Query or QueryBuilder
            $request->query->getInt('page', 1), // Current page, defaults to 1
            4 // Items per page
        );

        return $this->render('event_back/index.html.twig', [
            'pagination' => $pagination,
            'searchTerm' => $searchTerm,
        ]);
    }

    #[Route('/new', name: 'app_event_back_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(Event1Type::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_event_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event_back/new.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_back_show', methods: ['GET'])]
    public function show(Event $event): Response
    {
        return $this->render('event_back/show.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_event_back_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Event1Type::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($event->getImageFile()) {
                $event->setImageFile($event->getImageFile());
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_event_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event_back/edit.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_back_delete', methods: ['POST'])]
    public function delete(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $event->getId(), $request->request->get('_token'))) {
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_event_back_index', [], Response::HTTP_SEE_OTHER);
    }
}
