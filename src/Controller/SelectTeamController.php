<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SelectTeamController extends AbstractController
{
    #[Route('/select', name: 'app_select_team')]
    public function index(): Response
    {
        return $this->render('select_team/index.html.twig', [
            'controller_name' => 'SelectTeamController',
        ]);
    }
}
