<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use ErrorException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EmailConfirmationController extends AbstractController
{
    #[Route('/email/confirmation/{token}', name: 'app.email.confirmation')]
    public function index($token, UserRepository $userRepo, EntityManagerInterface $em): Response
    {
        $user = $userRepo->findOneBy(["token"=>$token]);
        if(!$user){
            throw $this->createNotFoundException("This token is invalid, please try registering again.");
        }

        $user->setToken(NULL);
        $user->setIsVerified(true);
        $em->persist($user);
        $em->flush();

        return $this->render('email_confirmation/index.html.twig', [
            'controller_name' => 'EmailConfirmationController',
            "user"=>$user
        ]);
    }
}
