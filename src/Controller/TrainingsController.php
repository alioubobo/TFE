<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Trainings;
use App\Form\TrainingsType;
use App\Repository\TrainingsRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Stripe\StripeClient;

class TrainingsController extends AbstractController
{
    /**
     * @Route("/addtrainings", name="add_trainings")           
    */
    
    public function addtrainigs(EntityManagerInterface $entityManager, Request $request): Response
    {
        $trainings = new Trainings();
       
        $form = $this->createForm(TrainingsType::class, $trainings);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {           
            $trainings = $form->getData();  
             //recover the images sent by the form
             $imgs = $form->get('images')->getData();
            
             //on boucle sur les images
            foreach($imgs as $images){
                 //generates a new file name
                 $fichier = md5(uniqid()) . '.' .$images->guessExtension();
 
                 //copies the file to the uploads folder
                 $images->move(
                     $this->getParameter('app.trainings_directory'),
                     $fichier
                 );
                 
                 $img = new Images();
                 $img->setImage($fichier);
                 $trainings->addImage($img);
 
            }             
            
            $entityManager->persist($trainings);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('trainings/addtrainings.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/showtrainings", name="show_trainings")
     */
    public function showTrainings(TrainingsRepository $trainingsRepository, 
    PaginatorInterface $paginator,
    Request $request): Response
    {
        $data = $trainingsRepository->findAll();

        $trainings = $paginator->paginate(
            $data, 
            $request->query->getInt('page', 1), //1 to show page 1 by default
            3 //3 represents the number of elements per page
        );
        return $this->render('trainings/showtrainings.html.twig', [
            'trainings' => $trainings,
        ]);
    }

    /**
     * @Route("/showtraining/{id}", name="show_training")
     */
    public function showTraining(Trainings $training): Response
    {
        return $this->render('trainings/detailtraining.html.twig', [
            'training' => $training,
        ]);
    }

    /**
     * @Route("/lasttrainings", name="last_trainings")
     */
    public function lastTrainings(TrainingsRepository $trainingsRepository): Response
    {
        return $this->render('trainings/_lasttrainings.html.twig', [
            'lasttrainings' => $trainingsRepository->lasttrainings(),
        ]);
    }

    /**
     * @Route("/forwardtraining", name="forward_training")
     */
    //Recuperation of the highlighted training
    public function forwardTraining(TrainingsRepository $trainingsRepository): Response
    {
        $forward_training = $trainingsRepository->isForward();

        // If no course has been highlighted, select the first validated course
        if(!$forward_training){
            $forward_training = $trainingsRepository->findOneBy(['validated' => 1]);
        }

        // If no course has been highlighted, select the first validated course
        if(is_array($forward_training)) {
            $forward_training = $forward_training[0];
        } 

        return $this->render('trainings/_forwardtraining.html.twig', [
            'forwardtraining' => $forward_training,
        ]);
    }   

}
