<?php

namespace App\Controller;

use App\Form\EditProfileType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="app_users")
     */
    public function index( Request $request): Response
    {      
        $user = $this->getUser(); 
        //check the user's role to direct them to the correct template
        if(in_array('COACH', $user->getRoles())){
            return $this->render('users/coachprofile.html.twig');
        }else if(in_array('CUSTOMER', $user->getRoles())){
            return $this->render('users/customerprofile.html.twig');
        }else if(in_array('ADMIN', $user->getRoles())){
            return $this->render('users/adminprofile.html.twig');
        }        

        return $this->render('users/_userprofile.html.twig');
        
    }

    /**
     * @Route("/users/profile/edit", name="users_edit_profile")
     */
    public function editProfile(EntityManagerInterface $entityManager,Request $request): Response
    {
        $user = $this->getUser();
        
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {           
            $user = $form->getData();              
           
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Your profile has been edited.');

            return $this->redirectToRoute('app_users');
        }

        if(in_array('COACH', $user->getRoles())){
             return $this->renderForm('users/editcoachprofile.html.twig', [
                'form' => $form,
            ]);
        }else if(in_array('CUSTOMER', $user->getRoles())){
            return $this->renderForm('users/editcustomerprofile.html.twig', [
                'form' => $form,
            ]);
        }

        return $this->renderForm('users/editcustomerprofile.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/users/password/edit", name="users_edit_password")
     */
    public function editPassword(EntityManagerInterface $entityManager, Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $session = $request->getSession();
       

        if($request->isMethod('Post')){

            $user = $this->getUser();
            
            if($request->request->get('pass') == $request->request->get('pass2')){
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('pass')));
                $entityManager->flush();
                $this->addFlash('success', 'the passwors updated.');

                return $this->redirectToRoute('app_users');
            }else{
                $this->addFlash('error', 'the passwors are diffirent.');
            }
        }        

        return $this->render('users/editpassword.html.twig');
    }
}
