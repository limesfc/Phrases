<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    #[Route('/newsletter', name: 'app_newsletter')]
    public function index(): Response
    {
        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'NewsletterController',
        ]);
    }
}
