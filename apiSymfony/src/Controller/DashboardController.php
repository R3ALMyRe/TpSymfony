<?php
// src/Controller/DashboardController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index()
    {
        // Cette page est accessible uniquement aux utilisateurs connectés
        return $this->render('dashboard/index.html.twig');
    }
}
