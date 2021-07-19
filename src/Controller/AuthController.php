<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    /**
     * 
     * Route("/auth", name="auth")
     */
    public function index(): Response
    {
        return $this->render('auth/index.html.twig', [
            'controller_name' => 'AuthController',
        ]);
    }

    /**
     * 
     * Route("/register", name="register")
     */
    public function register(): Response
    {
        $hello = "hello";
        return $this->render('auth/register.html.twig', [
            'hello' => $hello
        ]);
    }
}
