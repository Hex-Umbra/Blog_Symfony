<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationForm;
use App\Service\EmailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Uid\Uuid;
use Twig\Environment;

class RegistrationController extends AbstractController
{
    private $twig;
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    #[Route('/register', name: 'app.register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        EmailService $emailService,
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            // Generating a random token for email verification
            $token = Uuid::v4()->toRfc4122();
            $user->setToken($token);
            $user->setIsVerified(false);


            $entityManager->persist($user);
            $entityManager->flush();

            // Generation of the Email URL
            $confirmationEmail = $this->generateUrl(
                "app.email.confirmation",
                ["token" => $user->getToken()],
                UrlGeneratorInterface::ABSOLUTE_URL
            );

            $body = $this->twig->render("partials/confirmation_email.html.twig", [
                "url" => $confirmationEmail
            ]);
            // Send of the Email based on the Class EmailService
            $emailService->sendEmail(
                $user->getEmail(),
                "Email Validation",
                $body
            );
            $this->addFlash("success", "Registration successful. Please check your email to confirm your account.");
            return $this->redirectToRoute('app.login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
