<?php

namespace App\Controller;

use App\Entity\Allergy;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllergyController extends AbstractController
{
    #[Route('/allergie', name: 'app_allergy')]
    public function createAllergy(ManagerRegistry $doctrine): Response
    {
        $entitymanager = $doctrine->getManager();
        $allergies = array(
            'Gluten',
            'Crustacés',
            'Oeufs',
            'Poissons',
            'Arachides',
            'Soja',
            'Lait',
            'Fruit à coque',
            'Céleri',
            'Moutarde',
            'Graine de sésame',
            'Sulfites',
            'Lupin',
            'Mollusques',
        );

        $existingAllergies = $entitymanager->getRepository(Allergy::class)->findAll();

        if (count($existingAllergies) === 0) {
            foreach ($allergies as $allergyName) {
                $allergy = new Allergy();
                $allergy->setName($allergyName);
                $entitymanager->persist($allergy);
            }

            $entitymanager->flush();

            return new Response('Allergies ajoutées à la base de donnée :' . implode(', ', $allergies));
        } else {
            return new Response('Les allergies ont déjà été insérées dans la base de données.');
        }
    }
}
