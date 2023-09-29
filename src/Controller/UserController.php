<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'user_detail', methods:['GET'])]
    public function detail(User $user): Response
    {
        return $this->render('user/detail.html.twig', [
            'user' => $user,
        ]);
    }
}
