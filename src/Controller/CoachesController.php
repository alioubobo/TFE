<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Coaches;
use App\Form\CoachesType;
use App\Repository\CoachesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Contracts\Translation\TranslatorInterface;

class CoachesController extends AbstractController
{
    /**
     * @Route("/addcoaches", name="add_coaches")         
     */     
    //consists in creating a coach
    public function addCoaches(EntityManagerInterface $entityManager, Request $request, TranslatorInterface $translator): Response
    {
        $coach = new Coaches();
       
        $form = $this->createForm(CoachesType::class, $coach);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {           
            $coach = $form->getData();   
            
            $image = $form->get('images')->getData();
           
            //generates a new file name
            $fichier = md5(uniqid()) . '.' .$image->guessExtension();
            //copies the file to the uploads folder
            $image->move($this->getParameter('app.coaches_directory'), $fichier); 
            
            $img = new Images();
            $img->setImage($fichier);           
            $coach->setImage($img);

            $coach->setUsers($this->getUser());

            $entityManager->persist($coach);
            $entityManager->flush();

            $message = $translator->trans('Your email address has been verified.');
            $this->addFlash('success', $message);
            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('coaches/addcoaches.html.twig', [
            'form' => $form,
        ]);
    }

     /**
     * @Route("/showcoach/{id}", name="show_coach")
     */
     
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
