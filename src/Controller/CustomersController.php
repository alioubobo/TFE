<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Customers;
use App\Form\CustomersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Contracts\Translation\TranslatorInterface;

class CustomersController extends AbstractController
{
    /**    
     * @Route("/customers", name="add_customers")        
     */
    //consists in creating a coach    
    public function addcustomers(EntityManagerInterface $entityManager, Request $request, TranslatorInterface $traslator): Response
    {
        $customer = new Customers();
       
        $form = $this->createForm(CustomersType::class, $customer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {           
            $customer = $form->getData();  
            
            $image = $form->get('images')->getData();
           
            //generates a new file name
            $fichier = md5(uniqid()) . '.' .$image->guessExtension();
            //copies the file to the uploads folder
            $image->move($this->getParameter('app.customers_directory'), $fichier); 
            
            $img = new Images();
            $img->setImage($fichier);           
            $customer->setImage($img);

            $entityManager->persist($customer);
            $entityManager->flush();
            
            $message = $traslator->trans('Your email address has been verified.');
            $this->addFlash('success', $message);
            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('customers/addcustomers.html.twig', [
            'form' => $form,
        ]);
    }
}
