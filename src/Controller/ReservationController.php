<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use LogicException as GlobalLogicException;
use App\Repository\RestaurantHoursRepository;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Psr\Container\ContainerExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Exception\LogicException;
use Symfony\Component\Form\Exception\RuntimeException;
use Symfony\Component\Form\Exception\OutOfBoundsException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    #[Route('/reserver', name: 'reserver.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/reservation/index.html.twig', []);
    }

    /**
     * This controller allow us to make a reservation 
     * @param Request $request 
     * @param EntityManagerInterface $manager 
     * @param RestaurantHoursRepository $restaurantHoursRepository 
     * @return Response
     */
    #[Route('/reservation', name: 'reservation.index', methods: ['GET', 'POST'])]
    public function newReservation(Request $request, EntityManagerInterface $manager, RestaurantHoursRepository $restaurantHoursRepository): Response
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
            $hour = $formReservation->get('time_slot')->getData();
            $hourDateTime = \DateTime::createFromFormat('H:i', $hour);
            $reservation->setHour($hourDateTime);

            $date = $formReservation->get('Date')->getData();
            $restaurantHourId = $reservation->getRestaurantHourID($date);
            $restaurantHour = $restaurantHoursRepository->findOneBy([
                'id' => $restaurantHourId
            ]);
            $reservation->setRestaurantHour($restaurantHour);
            $user = $this->security->getUser();
            if ($user !== null) {
                $reservation->setUser($user);
            }
            $this->addFlash(
                'success',
                'Votre réservation a bien été créé'
            );

            $manager->persist($reservation);
            $manager->flush();
            return $this->redirectToRoute('security.login');
        }




        return $this->render('pages/reservation/index.html.twig', [
            'formReservation' => $formReservation->createView(),

        ]);
    }

    #[Route('/utilisateur/mes-reservations/{id}', name: 'my_reservation.index', methods: ['GET'])]
    public function myReservation(User $user, ReservationRepository $reservationRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }
        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('home.index');
        }
        $reservations = $reservationRepository->findBy(['User' => $this->getUser()]);


        return $this->render('pages/reservation/my_reservation.html.twig', [
            'reservations' => $reservations,
        ]);
    }
}
