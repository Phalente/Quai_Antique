<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    #[Route('/carte', name: 'carte.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/carte/index.html.twig', [
            'controller_name' => 'CarteController',
        ]);
    }
}
