<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="user/", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("{id}", name="profil")
     */
    public function userProfil(EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $entityManager->getRepository('App:User')->findOneBy(['email' => $request->get('id')]);


        return $this->render('user/profil.html.twig', compact('user'));
    }
}
