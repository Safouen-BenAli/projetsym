<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\SponsorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SponsorType; 
use App\Entity\Sponsor;
class SponsorBackController extends AbstractController
{
    #[Route('/back/office/Sponsor', name: 'app_back_Sponsor')]
    public function affich(SponsorRepository $rep): Response
    {
        
        $Sponsor = $rep->findAll();
        return $this->render('sponsor_back/index.html.twig', [
            'Sponsor' => $Sponsor,

        ]);
    }




    #[Route('/back/office/Sponsor/ajout', name: 'app_back_Sponsor_ajout')]
    public function ajout(ManagerRegistry $doctrine , Request $request): Response
    {
                 //instancier un objet
                 $Sponsor= new Sponsor();

                 $form=$this->createForm(SponsorType::class,$Sponsor);
                 //recuperer les donnees saisies au niveau de formulaire
                 
                 $form->handleRequest($request);
                 if($form->isSubmitted())
                 {

                 $em=$doctrine->getManager();
                 $em->persist($Sponsor);
                 $em->flush();
                 return $this->redirectToRoute('app_back_Sponsor');
                 }
        return $this->render('sponsor_back/form.html.twig', [
            'form' => $form->createView(),

        ]);
    }



///////////////////////////////////////


#[Route('/back/office/Sponsor/{id}', name: 'app_back_Sponsor_modif')]
public function modifliv( $id , SponsorRepository $rep ,ManagerRegistry $doctrine , Request $request): Response
{
             $Sponsor = $rep->find($id); // You can modify the query to fit your needs
     
             $form=$this->createForm(SponsorType::class,$Sponsor);
             //recuperer les donnees saisies au niveau de formulaire
             
             $form->handleRequest($request);
             if($form->isSubmitted())
             {
             $em=$doctrine->getManager();
             $em->persist($Sponsor);
             $em->flush();
             return $this->redirectToRoute('app_back_Sponsor');
             }
    return $this->render('sponsor_back/form.html.twig', [
        'form' => $form->createView(),
    ]);
}



///////////////////////////////////////////////////////

#[Route('/Sponsorupp/{id}', name: 'app_sponsordashsupp')]
public function livredashsupp( $id ,  SponsorRepository $rep, ManagerRegistry $doctrine): Response
{
    //recupere l auteur a supprimer
    $livre = $rep->find($id);
    // action de suppression
    $em=$doctrine->getManager();
    $em->remove($livre);
    //commit au niveau de la BD
    $em->flush();
    return $this->redirectToRoute('app_back_Sponsor');
}
}
