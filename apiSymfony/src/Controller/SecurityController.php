<?php
// src/Controller/SecurityController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    // Route pour afficher le formulaire de connexion
    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        // Cette méthode renverra un formulaire de connexion Twig
        return $this->render('security/login.html.twig');
    }

    // Route pour la déconnexion (symfony gère cela automatiquement)
    #[Route('/logout', name: 'logout')]
    public function logout()
    {
        // Symfony gère la déconnexion automatiquement, donc on n'a pas besoin d'implémenter de logique ici
    }
}


