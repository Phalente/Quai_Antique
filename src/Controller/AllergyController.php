<?php

namespace App\Controller;

use App\Entity\Allergy;
use App\Form\AllergyType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AllergyController extends AbstractController
{
    #[Route('/allergie', name: 'app_allergy')]
    #[IsGranted('ROLE_ADMIN')]

    public function createAllergy(ManagerRegistry $doctrine): Response
    {
        $entitymanager = $doctrine->getManager();
        $allergies = array(
            'Gluten ',
            'Crustacés ',
            'Oeufs ',
            'Poissons ',
            'Arachides ',
            'Soja ',
            'Lait ',
            'Fruits à coque ',
            'Céleri ',
            'Moutarde ',
            'Graines de sésame ',
            'Sulfites ',
            'Lupin ',
            'Mollusques ',
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

    #[Route('/allergyForm', name: 'allergyForm.index', methods: ['GET', 'POST'])]
    public function allergyForm(): Response
    {

        $formAllergy = $this->createForm(AllergyType::class);

        return $this->render('pages/allergy/index.html.twig', [
            'formAllergy' => $formAllergy->createView(),

        ]);
    }
}
