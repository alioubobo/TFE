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
    //Enables multifactor research
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

    //To filter the data encoded in the form
    /**
     * @Route("/filtersearch", name="filter_search", methods={"POST", "GET"})
     */
    
     public function filterSearch(Request $request, EntityManagerInterface $em, 
     PaginatorInterface $paginator,
     TranslatorInterface $translator): Response
    {
         //Recovering data via the form name
         $name = $request->request->get('nameCoach');
         $training = $request->request->get('nametrainings');         
        
         $coaches = $em->getRepository(Coaches::class)->findCoach($name, $training);   
        
         //check if the variable is empty to display a message
        if(empty($coaches)){
            $message = $translator->trans("Oops there is no correspondent.");
            $this->addFlash("info", $message);            
        }
        
        //pagination
        $coaches = $paginator->paginate( 
            $coaches,           
            $request->query->getInt('page', 1), //1 to show page 1 by default
            3 //3 represents the number of elements per page
        );

        return $this->render('coaches/_searchresult.html.twig', [
            'coaches' => $coaches,
        ]);
    }
}