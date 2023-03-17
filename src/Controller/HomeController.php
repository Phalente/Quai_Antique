<?php

namespace App\Controller;

use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index', methods: ['GET'])]
    public function index(PictureRepository $pictureRepository): Response
    {
        $sliderPicture = $pictureRepository->findSliderPicture();

        return $this->render('home.html.twig', [
            'sliderPicture' => $sliderPicture,
        ]);
    }
}
