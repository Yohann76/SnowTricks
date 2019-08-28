<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Media;
use App\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TricksRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RedirectResponse;


class TricksController extends AbstractController
{
    /**
     * @var TricksRepository
     */
    private $repository;

    /**
     * @var ObjectManager $om
     */
    private $om;

    public function __construct(TricksRepository $repository, ObjectManager $om)
    {
        $this->repository = $repository;
        $this->om = $om ; 
    }
    

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage() 
    {
        $tricks = $this->repository->findLatest();

        //  $medias = $this->repository->find();


        return $this->render('tricks/index.html.twig', [
           // 'medias' => $medias,
            'tricks' => $tricks
        ]);
    }

    /**
     * @Route("/tricks/{slug}-{id}", name="tricks_single", requirements={"slug": "[a-z0-9\-]*" })
     */
    public function single(Tricks $tricks, string $slug, Request $request) :Response
    {
       // if !slug  
       if($tricks->getSlug() !== $slug ) {
            return $this->redirectToRoute('tricks_single', [
                'id' => $tricks->getId(), 
                'slug' => $tricks->getSlug()
            ],301);
        }

        
        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
 
             $comment = $form->getData();
 
             $comment->setUser($this->getUser() );
                               
             $comment->setTricks($tricks);
 
             $em = $this->getDoctrine()->getManager();
             $em->persist($comment);
             $em->flush();

             return $this->redirectToRoute('tricks_single', [
                'id' => $tricks->getId(), 
                'slug' => $tricks->getSlug()
            ],301);
         }


         $medias = $tricks->getMedia();

         return $this->render('tricks/single.html.twig', [
            'tricks' => $tricks,
           // 'name_user' => $user,
             'medias' => $medias,
            'commentForm' => $form->createView()
        ]);

    }

}
