<?php

namespace App\Controller;

use App\Repository\InteretRepository;
use App\Repository\FormationRepository;
use App\Repository\CompetenceRepository;
use App\Repository\ExperienceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CvController extends AbstractController
{
    #[Route('/cv', name: 'app_cv')]
    public function index(ExperienceRepository $exp, CompetenceRepository $comp, FormationRepository $formation, InteretRepository $interet): Response
    {
        $monexperience= $exp -> findAll(); 
        $mescompetences= $comp -> findAll();
        $mesformations = $formation -> findAll();
        $mesinterets= $interet -> findAll(); 
        
        return $this->render('cv/index.html.twig', [
            'experience' => $monexperience,
            'competence' => $mescompetences,
            'formation' => $mesformations,
            'interet' => $mesinterets
        ]);
    }
}