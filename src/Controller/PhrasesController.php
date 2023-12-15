<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignUpType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhrasesController extends AbstractController
{
    #[Route('/', name: 'phrases_signup', methods: ['GET', 'POST'])]
    public function signup(Request $request): Response
    {
        $form = $this->createForm(SignUpType::class, new User());

        return $this->render('phrases/index.html.twig', [
            'sign_up_form' => $form,
        ]);
    }
}
