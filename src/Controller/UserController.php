<?php

namespace App\Controller;

use App\Entity\ContactUrgence;
use App\Entity\Handicap;
use App\Entity\User;
use App\Form\ContactUrgenceInfoType;
use App\Form\HandicapInfoType;
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

        $contactUrgence = new ContactUrgence();
        $userContactInfoForm = $this->createForm(ContactUrgenceInfoType::class, $contactUrgence);

        $userHandicap = new Handicap();
        $handicapUserForm = $this->createForm(HandicapInfoType::class, $userHandicap);

        $userBasicInfoForm->handleRequest();
        $userContactInfoForm->handleRequest();
        $handicapUserForm->handleRequest();
        if($userBasicInfoForm->isSubmitted() && $userBasicInfoForm->isValid() && $handicapUserForm->isSubmitted() &&
            $handicapUserForm->isValid() && $userContactInfoForm->isSubmitted() && $userContactInfoForm->isValid()){
            // encode the plain password
            $user->setPassword(
                $userPasswordEncoderInterface->encodePassword(
                    $user,
                    '123456'
                )
            );
            $user->addContactUrgence($contactUrgence);
            $user->addHandicap($userHandicap);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->persist($contactUrgence);
            $entityManager->persist($userHandicap);
            $entityManager->flush();

            $this->redirectToRoute('index');
        }



        return $this->render('user/compte.html.twig', [
            'basicForm' => $userBasicInfoForm->createView(),
            'contactForm'=> $userContactInfoForm->createView(),
            'handicapForm'=> $handicapUserForm->createView(),
            compact('user')
        ]);
    }
}
