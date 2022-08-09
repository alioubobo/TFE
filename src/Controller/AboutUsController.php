<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutUsController extends AbstractController
{
    /**
     * @Route("/about", name="about_us")
     */
    public function aboutUs(): Response
    {
        return $this->render('about_us/about.html.twig');
    }
}
