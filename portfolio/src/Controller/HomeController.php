<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController{
    #[Route(path: '/', name: 'home')]
    public function index():Response{
        $user = $this->getUser();
        return $this->render('index.html.twig', [
            'user' => $user,
        ]);
    }
}
?>