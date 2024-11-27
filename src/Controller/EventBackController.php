<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\EventRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EventType; 
use App\Entity\Event;
class EventBackController extends AbstractController
{
    #[Route('/back/office/Event', name: 'app_back_Event')]
    public function affich(EventRepository $rep): Response
    {
        
        $Event = $rep->findAll();
        return $this->render('event_back/index.html.twig', [
            'Event' => $Event,

        ]);
    }




    #[Route('/back/office/Event/ajout', name: 'app_back_Event_ajout')]
    public function ajout(ManagerRegistry $doctrine , Request $request): Response
    {
                 //instancier un objet
                 $Event= new Event();

                 $form=$this->createForm(EventType::class,$Event);
                 //recuperer les donnees saisies au niveau de formulaire
                 
                 $form->handleRequest($request);
                 if($form->isSubmitted())
                 {

                 $em=$doctrine->getManager();
                 $em->persist($Event);
                 $em->flush();
                 return $this->redirectToRoute('app_back_Event');
                 }
        return $this->render('event_back/form.html.twig', [
            'form' => $form->createView(),

        ]);
    }



///////////////////////////////////////


#[Route('/back/office/Event/{id}', name: 'app_back_Event_modif')]
public function modifliv( $id , EventRepository $rep ,ManagerRegistry $doctrine , Request $request): Response
{
             $Event = $rep->find($id); // You can modify the query to fit your needs
     
             $form=$this->createForm(EventType::class,$Event);
             //recuperer les donnees saisies au niveau de formulaire
             
             $form->handleRequest($request);
             if($form->isSubmitted())
             {
             $em=$doctrine->getManager();
             $em->persist($Event);
             $em->flush();
             return $this->redirectToRoute('app_back_Event');
             }
    return $this->render('event_back/form.html.twig', [
        'form' => $form->createView(),
    ]);
}



///////////////////////////////////////////////////////

#[Route('/Eventupp/{id}', name: 'app_Eventdashsupp')]
public function livredashsupp( $id ,  EventRepository $rep, ManagerRegistry $doctrine): Response
{
    //recupere l auteur a supprimer
    $livre = $rep->find($id);
    // action de suppression
    $em=$doctrine->getManager();
    $em->remove($livre);
    //commit au niveau de la BD
    $em->flush();
    return $this->redirectToRoute('app_back_Event');
}
}
