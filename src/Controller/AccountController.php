<?php

namespace App\Controller;

use App\Form\PictureUserType;
use App\Repository\TricksRepository;
use App\Repository\UserRepository;
use App\Service\FileUploader;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * @IsGranted("ROLE_USER")
 */
class AccountController extends BaseController
{
    /**
     * @Route("public/account", name="app_account")
     */
    public function index(LoggerInterface $logger,Request $request,UserRepository $userRepo, FileUploader $fileUploader,EntityManagerInterface $entityManager)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(PictureUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $PictureFile = $form->get('picture')->getData();
            if($PictureFile); {
                $originalFilename = pathinfo($PictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$PictureFile->guessExtension();
                try {
                    $PictureFile->move(
                        $this->getParameter('PictureUser_directory'), // In Service.yaml
                        $newFilename
                    );
                }
                catch (FileException $e) {
                    $this->addFlash('info','Un probléme à persister');
                }
            }
            $user->setPicture($newFilename);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('info','Votre photo de profil a bien été modifier!');
            return $this->redirectToRoute('app_account');
        }

        return $this->render('account/index.html.twig', [
            'PictureUserType' => $form->createView(),
        ]);
    }
}
