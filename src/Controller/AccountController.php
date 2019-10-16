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
            if($PictureFile);
            $originalFilename = pathinfo($PictureFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$PictureFile->guessExtension();
            // Move the file to the directory where brochures are stored
            try {
                $PictureFile->move(
                    $this->getParameter('PictureUser_directory'), // Spécifié dans Service.yaml
                    $newFilename
                );
            } catch (FileException $e) {
                $this->addFlash(
                    'info',
                    "a problem exist with your upload "
                );
            }
            $user->setPicture($newFilename);
            return $this->redirectToRoute('app_account');
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('account/index.html.twig', [
            'PictureUserType' => $form->createView(),
        ]);
    }

}
