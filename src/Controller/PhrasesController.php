<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhrasesController extends AbstractController
{
    #[Route('/', name: 'phrases_signup', methods: ['GET', 'POST'])]
    public function signup(Request $request): Response
    {
        $success = false;
        $errors = [];

        if ($request->isMethod('POST')) {
            // Handle form submission
            $email = $request->request->get('email');

            // Perform validation (you can use Symfony's validator component)
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Invalid email address';
            } else {
                // Save the email to your newsletter subscribers list or database
                // For simplicity, we'll just set success to true
                $success = true;
            }
        }

        return $this->render('phrases/index.html.twig', [
            'success' => $success,
            'errors' => $errors,
        ]);
    }
}
