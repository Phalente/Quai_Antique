<?php

namespace App\Controller;

use App\Repository\MealsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MealsController extends AbstractController
{
    /**
     * This function display all meals
     *
     * @param MealsRepository $repository
     * @param Request $request
     * @return Response
     */

    #[Route('/meal', name: 'app_meal')]
    public function index(MealsRepository $mealsRepository): Response
    {

        $meals = $mealsRepository->findAll();
        $entrees = $mealsRepository->findByCategoriesID(1);
        $plats = $mealsRepository->findByCategoriesID(2);
        $desserts = $mealsRepository->findByCategoriesID(3);
        $burgers = $mealsRepository->findByCategoriesID(4);
        $boissons = $mealsRepository->findByCategoriesID(5);


        return $this->render('pages/meal/index.html.twig', [
            'entrees' => $entrees,
            'plats' => $plats,
            'desserts' => $desserts,
            'burgers' => $burgers,
            'boissons' => $boissons,
        ]);
    }
}
