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

class CustomersController extends AbstractController
{
    /**
     * @Route("/customers", name="add_customers")
     *      
     */
    //* @SecuritY("has_role('ROLE_USER')")
    //consiste à securiser la méthode
    public function addcustomers(EntityManagerInterface $entityManager, Request $request): Response
    {
        $customer = new Customers();
       
        $form = $this->createForm(CustomersType::class, $customer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {           
            $customer = $form->getData();  
            
            $image = $form->get('images')->getData();
           
            //on génère un nouveau nom de fichier
            $fichier = md5(uniqid()) . '.' .$image->guessExtension();
            //on copie le fichier dans le dossier uploads
            $image->move($this->getParameter('app.customers_directory'), $fichier); 
            
            $img = new Images();
            $img->setImage($fichier);           
            $customer->setImage($img);

            $entityManager->persist($customer);
            $entityManager->flush();
            $this->addFlash('success', 'Your email address has been verified.');
            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('customers/addcustomers.html.twig', [
            'form' => $form,
        ]);
    }
}
