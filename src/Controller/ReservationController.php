<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function newReservation(Request $request, EntityManagerInterface $manager): Response
    {

        $reservation = new Reservation;
        $formReservation = $this->createForm(ReservationType::class, $reservation);
        $formReservation->handleRequest($request);

        if ($formReservation->isSubmitted() && $formReservation->isValid()) {
            $reservation = $formReservation->getData();
            $allergies = $formReservation->get('Allergies')->getData();
            foreach ($allergies as $allergy) {
                $reservation->addAllergy($allergy);
            }

            $this->addFlash(
                'success',
                'Votre compte a bien été créé'
            );

            $manager->persist($reservation);
            $manager->flush();
            return $this->redirectToRoute('security.login');
        }

        $selectedDate = $request->query->get('selected_date');



        return $this->render('pages/reservation/index.html.twig', [
            'formReservation' => $formReservation->createView(),

        ]);
    }
}
