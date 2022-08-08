<?php

namespace App\Controller;

use App\Entity\Coaches;
use App\Entity\Trainings;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * @Route("/searchcoaches", name="search_coaches")
     */
    //permet de récuperer les données de la BD 
    public function searchCoaches(EntityManagerInterface $em){
        
        $coachs = $em->getRepository(Coaches::class)->findAll();
        $trainings = $em->getRepository(Trainings::class)->findAll();       

        return $this->render('coaches/_searchcoaches.html.twig', [
            'coaches' => $coachs,
            'trainings' => $trainings,            
        ]);
    }

    /**
     * @Route("/filtersearch", name="filter_search", methods={"POST", "GET"})
     */

     //Permet de filtrer les données encoder dans le formulaire
     public function filterSearch(Request $request, EntityManagerInterface $em, 
     PaginatorInterface $paginator,
     TranslatorInterface $translator): Response
    {
         //Récupération des données via le name du formulaire
         $name = $request->request->get('nameCoach');
         $training = $request->request->get('nametrainings');         
        
         $coaches = $em->getRepository(Coaches::class)->findCoach($name, $training);   
        
         //permet de vérifier si la variable est vide pour afficher un message 
        if(empty($coaches)){
            $message = $translator->trans('No results for this item!');
            $this->addFlash("pasdecoach", $message);
        }
        
        //la pagignation
        $coaches = $paginator->paginate( 
            $coaches,           
            $request->query->getInt('page', 1),//1 pour afficher par defaut la page 1
            3 //3 répresente le nbre d'élément par page
        );

        return $this->render('coaches/_searchresult.html.twig', [
            'coaches' => $coaches,
        ]);
    }
}