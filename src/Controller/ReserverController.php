<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReserverController extends AbstractController
{
    #[Route('/reserver', name: 'reserver.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/reserver/index.html.twig', [
            'controller_name' => 'ReserverController',
        ]);
    }
}
