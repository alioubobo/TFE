<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Trainings;
use App\Form\TrainingsType;
use App\Repository\TrainingsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class TrainingsController extends AbstractController
{
    /**
     * @Route("/addtrainings", name="add_trainings")
     *      
     */
    //* @SecuritY("has_role('ROLE_USER')")
    //consiste à securiser la méthode
    public function addCoaches(EntityManagerInterface $entityManager, Request $request): Response
    {
        $trainings = new Trainings();
       
        $form = $this->createForm(TrainingsType::class, $trainings);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {           
            $trainings = $form->getData();  
             //on récupère les images transmises par le formulaire
             $imgs = $form->get('images')->getData();
            
             //on boucle sur les images
            foreach($imgs as $images){
                 //on génère un nouveaunom de fichier
                 $fichier = md5(uniqid()) . '.' .$images->guessExtension();
 
                 //on copie le fichier dans le dossier uploads
                 $images->move(
                     $this->getParameter('app.trainings_directory'),
                     $fichier
                 );
                 //on stocke l'image dans la base de données (seulement son nom)
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
            $request->query->getInt('page', 1),//1 pour afficher par defaut la page 1
            3 //3 répresente le nbre d'élément par page
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

    //Recuperation de la formation mise en avant
    public function forwardTraining(TrainingsRepository $trainingsRepository): Response
    {
        $this->trainingsRepository = $trainingsRepository;

        $forward_training = $this->trainingsRepository->isForward();

        // Si aucune formation n'a été mise en avant, prendre la première formation validée
        if(!$forward_training){
            $forward_training = $this->trainingsRepository->findOneBy(['validated' => 1]);
        }

        // Si plus d'une catégorie a été mise en avant, prendre la première catégorie en avant
        if(is_array($forward_training)) {
            $forward_training = $forward_training[0];
        } 

        return $this->render('trainings/_forwardtraining.html.twig', [
            'forwardtraining' => $forward_training,
        ]);
    }
}
