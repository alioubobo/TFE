<?php

namespace App\Controller;

use App\Entity\Coaches;
use App\Form\CoachesType;
use App\Repository\CoachesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoachesController extends AbstractController
{
    /**
     * @Route("/addcoaches", name="add_coaches")
     */
    public function addCoaches(EntityManagerInterface $entityManager, Request $request): Response
    {
        $coach = new Coaches();
       
        $form = $this->createForm(CoachesType::class, $coach);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {           
            $coach = $form->getData();                 

            $entityManager->persist($coach);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('coaches/addcoaches.html.twig', [
            'form' => $form,
        ]);
    }

     /**
     * @Route("/showcoach/{id}", name="show_coach")
     */

     //Affichage d'un coach
     public function showCoach(Coaches $coach): Response
     {
        return $this->render('coaches/detailcoach.html.twig', [
            'coach' => $coach,
        ]);
     }

    /**
     * @Route("/coaches", name="app_coaches")
     */
    public function showCoaches(CoachesRepository $coachesRepository): Response
    {
        return $this->render('coaches/coaches.html.twig', [
            'coaches' => $coachesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/lastcoaches", name="last_coaches")
     */
    public function lastCoaches(CoachesRepository $coachesRepository): Response
    {
        return $this->render('coaches/_lastcoaches.html.twig', [
            'lastCoaches' => $coachesRepository->lastCoaches(),
        ]);
    }
}
