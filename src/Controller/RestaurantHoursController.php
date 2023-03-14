<?php

namespace App\Controller;

use App\Entity\RestaurantHours;
use App\Repository\RestaurantHoursRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RestaurantHoursController extends AbstractController
{

  #[Route('/addhoraire', name: 'app_hours')]
  public function createRestaurantHours(ManagerRegistry $doctrine): Response
  {
    $entitymanager = $doctrine->getManager();
    $daysOfWeek = array(
      'Lundi',
      'Mardi',
      'Mercredi',
      'Jeudi',
      'Vendredi',
      'Samedi',
      'Dimanche'
    );
    $halfDay = array('Service du midi', 'Service du soir');

    $timeSlots = $entitymanager->getRepository(RestaurantHours::class)->findAll();

    if (count($timeSlots) === 0) {
      foreach ($daysOfWeek as $dayName) {
        $restaurantHour = new RestaurantHours;
        $restaurantHour->setDay($dayName)
          ->setOpeningLunch(\DateTime::createFromFormat('H:i', '12:00'))
          ->setClosingLunch(\DateTime::createFromFormat('H:i', '15:00'))
          ->setPlacesAvailableLunch(100)
          ->setOpeningDinner(\DateTime::createFromFormat('H:i', '20:00'))
          ->setClosingDinner(\DateTime::createFromFormat('H:i', '23:00'))
          ->setPlacesAvailableDinner(100);
        $entitymanager->persist($restaurantHour);
      }

      $entitymanager->flush();

      return new Response('Les créneaux ont été ajoutées à la base de donnée :' . implode(', ', $daysOfWeek));
    } else {
      return new Response('Les créneaux ont déjà été insérées dans la base de données.');
    }
  }

  #[Route('/horaire', name: 'app_restaurant_hours')]
  public function index(RestaurantHoursRepository $restaurantHoursRepository): Response
  {
    $restaurantHours = $restaurantHoursRepository->findAll();

    return $this->render('pages/restaurant_hours/index.html.twig', [
      'restaurantHours' => $restaurantHours
    ]);
  }
  #[Route('/horaires', name: 'app_restaurant_hours')]

  public function getRestaurantHours(RestaurantHoursRepository $restaurantHoursRepository): array
  {
    $restaurantHours = $restaurantHoursRepository->findAll();

    $openingLunch = [];
    $closingLunch = [];
    $openingDinner = [];
    $closingDinner = [];

    foreach ($restaurantHours as $hours) {
      $openingLunch[$hours->getDay()] = $hours->getOpeningLunch();
      $closingLunch[$hours->getDay()] = $hours->getOpeningLunch();
      $openingDinner[$hours->getDay()] = $hours->getOpeningDinner();
      $closingDinner[$hours->getDay()] = $hours->getClosingDinner();
    }
    dd(
      $openingLunch,
      $closingLunch,
      $openingDinner,
      $closingDinner
    );

    return [
      'openingLunch' => $openingLunch,
      'closingLunch' => $closingLunch,
      'openingDinner' => $openingDinner,
      'closingDinner' => $closingDinner
    ];
  }
}
