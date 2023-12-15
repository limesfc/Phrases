<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignUpType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class PhrasesController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    #[Route('/', name: 'phrases_signup', methods: ['GET', 'POST'])]
    public function signup(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(SignUpType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setIsActive(true);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $this->redirectToRoute('phrases_signup');
        }

        return $this->render('phrases/index.html.twig', [
            'sign_up_form' => $form,
        ]);
    }
}
