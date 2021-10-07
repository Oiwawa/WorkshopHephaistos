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
    public function userAccount(EntityManagerInterface $entityManager, Request $request, UserPasswordEncoderInterface $userPasswordEncoder): Response
    {
        $allCategories = $entityManager->getRepository('App:CategorieHandicap')->findAll();
        $allTypesHan = $entityManager->getRepository('App:TypeHandicap')->findAll();
        $user = $entityManager->getRepository('App:User')->findOneBy(['email'=>$this->getUser()->getUsername()]);
        $contactUrgence = $entityManager->getRepository('App:User')->findOneBy(['id' => $user->getId()]);
        $contactUrgence = $user->getContactUrgence();
        if ($request->query->get('email')){

            $contactUrgence = new ContactUrgence();
            $contactUrgence->setNom($request->query->get('contact_nom'));
            $contactUrgence->setPrenom($request->query->get('contact_prenom'));
            $contactUrgence->setEmail($request->query->get('contact_email'));
            $contactUrgence->setTelephone($request->query->get('contact_telephone'));
            $user->addContactUrgence($contactUrgence);

            $handicap = new Handicap();
            $typeHan = $entityManager->getRepository('App:TypeHandicap')->findOneBy(['id' => $request->query->get('type_han')]);
            $catHan = $entityManager->getRepository('App:CategorieHandicap')->findOneBy(['id' => $request->query->get('cat_han')]);
            $handicap->setCategorieCPAM($request->query->get('han_cat_cpam'));
            $handicap->setTxIncapacitePerm($request->query->get('tx_incap_perm'));
            $handicap->setNumAggir($request->query->get('num_aggir'));
            $handicap->setCategorieHandicap($catHan);
            $handicap->setTypeHandicap($typeHan);
            $handicap->setInfosComplementaires($request->query->get('infos_comp'));
            $user->addHandicap($handicap);

            $entityManager->persist($contactUrgence);
            $entityManager->persist($handicap);
            $entityManager->persist($user);
            $entityManager->flush();

        $this->redirectToRoute('index');
        }

        return $this->render('user/compte.html.twig', [
            'allCategories' => $allCategories,
            'allTypesHan' => $allTypesHan,
            'user' => $user,
            'contactUrgence' => $contactUrgence
        ]);
    }
}
