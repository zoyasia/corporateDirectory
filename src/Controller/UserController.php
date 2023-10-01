<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'user_detail', methods:['GET'])]
    public function detail(UserRepository $userRepository, int $id): Response
    {

        $user = $userRepository
        ->find($id);

        return $this->render('user/detail.html.twig', [
            'user' => $user,
        ]);
    }
}