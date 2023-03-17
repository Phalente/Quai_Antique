<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\MealRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MealController extends AbstractController
{
    /**
     * This function display all meals
     *
     * @param MealRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/carte', name: 'carte.index')]
    public function index(MealRepository $mealRepository): Response
    {
        $entrees = $mealRepository->findMealsByCategoryId(1);
        $plats = $mealRepository->findMealsByCategoryId(2);
        $desserts = $mealRepository->findMealsByCategoryId(3);
        $boissons = $mealRepository->findMealsByCategoryId(4);
        $meals = $mealRepository->findAll();


        return $this->render('pages/meal/index.html.twig', [
            'meals' => $meals,
            'entrees' => $entrees,
            'plats' => $plats,
            'desserts' => $desserts,
            'boissons' => $boissons,
        ]);
    }
}
