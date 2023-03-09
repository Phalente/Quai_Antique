<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reserver', name: 'reserver.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/reservation/index.html.twig', []);
    }

    #[Route('/reservation', name: 'reservation.index', methods: ['GET', 'POST'])]
    public function newReservation(): Response
    {

        $reservation = new Reservation;
        $formReservation = $this->createForm(ReservationType::class, $reservation);
        $date = $formReservation->get('Date')->getData();

        return $this->render('pages/reservation/index.html.twig', [
            'formReservation' => $formReservation->createView(),
            'date' => $date,
        ]);
    }
}
