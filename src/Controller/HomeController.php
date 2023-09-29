<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function listUsers(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        
        return $this->render('home/index.html.twig', [
            'users' => $users
        ]);
    }
}
