<?php

namespace App\Controller;

use App\Entity\Equipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\EquipeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CreateController extends AbstractController
{
    #[Route('/create', name: 'app_create', methods: ['GET', 'POST'])]
    public function new(Request $request, EquipeRepository $equipeRepository): Response
    {
        $equipe = new Equipe();

        $form = $this->createFormBuilder($equipe)
            ->add('nom', TextType::class, ['label' => 'Nom'])
            ->add('ville', TextType::class, ['label' => 'Ville'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $equipeRepository->save($equipe, true);

            return $this->redirectToRoute('app_equipe');
        }
            
        return $this->render('create/index.html.twig', [
            'controller_name' => 'CreateController',
            'equipe' => $equipe,
            'form' => $form->createView()
        ]);
    }
}
