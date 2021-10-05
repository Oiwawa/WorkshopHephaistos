<?php

namespace App\Controller;

use App\Entity\ContactUrgence;
use App\Entity\Handicap;
use App\Entity\User;
use App\Form\ContactUrgenceInfoType;
use App\Form\UserBasicInfoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route(path="user", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route(path="{id}", name="profil")
     */
    public function userProfil(EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $entityManager->getRepository('App:User')->findOneBy(['id' => $request->get('id')]);
        return $this->render('user/compte.html.twig', compact('user'));
    }

    /**
     * @Route(path="/compte", name="account")
     */
    public function userAccount(EntityManagerInterface $entityManager, Request $request, UserPasswordEncoderInterface $userPasswordEncoderInterface): Response
    {
        $user = new User();
        $userBasicInfoForm = $this->createForm(UserBasicInfoType::class, $user);
        if($userBasicInfoForm->isSubmitted() && $userBasicInfoForm->isValid() ){
            $userBasicInfoForm->handleRequest();
            $userCo = $entityManager->getRepository('App:User')->findOneBy(['email' => $request->get('email')]);
            if ($userCo){
                $user = $userCo;
                return $this->render('user/compte.html.twig', compact('user'));
            }
            // encode the plain password
            $user->setPassword(
                $userPasswordEncoderInterface->encodePassword(
                    $user,
                    '123456'
                )
            );
        }
        $contactUrgence = new ContactUrgence();
        $userContactInfoForm = $this->createForm(ContactUrgenceInfoType::class, $contactUrgence);
        if($userContactInfoForm->isSubmitted() && $userContactInfoForm->isValid()){
            $user->addContactUrgence($contactUrgence);
        }

        $handicapUser = new Handicap();


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user, $contactUrgence);
        $entityManager->flush();
        if ($user && $contactUrgence && $handicapUser){
            return $this->redirectToRoute('index');
        }
        return $this->render('user/compte.html.twig', [
            'basicForm' => $userBasicInfoForm->createView(),
            compact('user')
        ]);
    }
}
