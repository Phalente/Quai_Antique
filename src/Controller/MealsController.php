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

    #[Route('/carte', name: 'app_meal')]
    public function index(MealsRepository $mealsRepository): Response
    {

        $meals = $mealsRepository->findAll();
        $fondues = $mealsRepository->findByCategoriesID(1);
        $plats = $mealsRepository->findByCategoriesID(2);
        $salades = $mealsRepository->findByCategoriesID(4);
        $desserts = $mealsRepository->findByCategoriesID(3);
        $boissons = $mealsRepository->findByCategoriesID(5);


        return $this->render('pages/meal/index.html.twig', [
            'fondues' => $fondues,
            'plats' => $plats,
            'salades' => $salades,
            'desserts' => $desserts,
            'boissons' => $boissons,
        ]);
    }
}
