<?php

namespace App\Controller;

use App\Entity\Categories;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoriesController extends AbstractController
{
    #[Route('/categorie', name: 'app_categories')]
    public function createCategories(ManagerRegistry $doctrine): Response
    {
        $entitymanager = $doctrine->getManager();
        $category = array(
            'Entrées',
            'Plats',
            'Desserts',
            'Boissons'
        );

        $existingCategories = $entitymanager->getRepository(Categories::class)->findAll();

        if (count($existingCategories) === 0) {
            foreach ($category as $categoryName) {
                $categories = new Categories();
                $categories->setName($categoryName);
                $entitymanager->persist($categories);
            }

            $entitymanager->flush();

            return new Response('Catégories ajoutées à la base de donnée :' . implode(', ', $category));
        } else {
            return new Response('Les catégories ont déjà été insérées dans la base de données.');
        }
    }
}
