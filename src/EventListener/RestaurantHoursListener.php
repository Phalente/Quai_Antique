<?php

namespace App\EventListener;

use App\Repository\RestaurantHoursRepository;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

class RestaurantHoursListener
{
  private $restaurantHoursRepository;

  public function __construct(RestaurantHoursRepository $restaurantHoursRepository)
  {
    $this->restaurantHoursRepository = $restaurantHoursRepository;
  }

  public function onKernelController(ControllerEvent $event)
  {
    $restaurantHours = $this->restaurantHoursRepository->findAll();
    $event->getRequest()->attributes->set('restaurantHours', $restaurantHours);
  }
}
