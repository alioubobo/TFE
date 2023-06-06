<?php

namespace App\Controller;

use App\Form\EditProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="app_users")
     */
    public function index(Request $request): Response
    {   
        // if($request->request->get('coach')){
        //     return $this->render('users/coachprofile.html.twig');
        // }elseif($request->request->get('customer')){
        //     return $this->render('users/customerprofile.html.twig');
        // }

        return $this->render('users/coachprofile.html.twig');
        
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

        return $this->renderForm('users/editprofile.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/users/password/edit", name="users_edit_password")
     */
    public function editPassword(EntityManagerInterface $entityManager, Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        if($request->isMethod('Post')){

            $user = $this->getUser();

            if($request->request->get('pass') == $request->request->get('pass2')){
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('pass')));
                $entityManager->flush();
                $this->addFlash('success', 'the passwors updated.');

                return $this->redirectToRoute('app_users');
            }else{
                $this->addFlash('error', 'the passwors are diffrent.');
            }
        }        

        return $this->render('users/editpassword.html.twig');
    }
}
