<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SponsorBackController extends AbstractController
{
    #[Route('/sponsor/back', name: 'app_sponsor_back')]
    public function index(): Response
    {
        return $this->render('sponsor_back/index.html.twig', [
            'controller_name' => 'SponsorBackController',
        ]);
    }
}
