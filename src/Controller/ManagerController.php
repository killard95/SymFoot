<?php

namespace App\Controller;

use App\Repository\ManagerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManagerController extends AbstractController
{
    #[Route('/manager', name: 'app_manager')]
    public function index(ManagerRepository $managerRepository): Response
    {
        return $this->render('manager/index.html.twig', [
            'controller_name' => 'ManagerController',
            'managers' => $managerRepository->findAll(),
            'nomEquipe' => $managerRepository->getNomEquipe(),
        ]);
    }
}
