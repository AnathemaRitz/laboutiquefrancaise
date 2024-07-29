<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegisterController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }

    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request): Response
    {
        $user = new User ();
        $form= $this-> createForm(RegisterUserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash(
                "success",
                "Votre compte a bien été créé. Vous pouvez vous connecter"
            );

            return $this->redirectToRoute('app_login');
        }



        return $this->render('register/index.html.twig', [
            'registerForm'=>$form->createView()
        ]);
    }
}
