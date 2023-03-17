<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/categorie', name: 'app_category')]
    public function createCategory(ManagerRegistry $doctrine): Response
    {
        $entitymanager = $doctrine->getManager();
        $categories = array(
            'Entrées',
            'Plats',
            'Desserts',
            'Boissons'
        );

        $existingCategories = $entitymanager->getRepository(Category::class)->findAll();

        if (count($existingCategories) === 0) {
            foreach ($categories as $categoryName) {
                $category = new Category();
                $category->setName($categoryName);
                $entitymanager->persist($category);
            }

            $entitymanager->flush();

            return new Response('Catégories ajoutées à la base de donnée :' . implode(', ', $categories));
        } else {
            return new Response('Les catégories ont déjà été insérées dans la base de données.');
        }
    }
}
