<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Créer un nouvel utilisateur
        $user = new User();

        // Créer le formulaire d'inscription
        $form = $this->createForm(RegistrationType::class, $user);

        // Traiter le formulaire à la soumission
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encoder le mot de passe
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);

            // Sauvegarder l'utilisateur dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // Rediriger l'utilisateur vers la page de connexion après l'inscription
            $this->addFlash('success', 'Votre inscription a été réussie. Vous pouvez maintenant vous connecter.');
            return $this->redirectToRoute('app_login');
        }

        // Rendre la vue du formulaire d'inscription
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
