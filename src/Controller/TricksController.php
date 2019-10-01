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
     * Display the home page
     * @Route("/", name="app_homepage")
     */
    public function homepage(TricksRepository $repository)
    {
        // Get 8 tricks from position 0
        $tricks = $repository->findBy([], ['publishedAt' => 'DESC'], 8, 0);

        return $this->render('tricks/index.html.twig', [
            'tricks' => $tricks
        ]);
    }

    /**
     * Get the 8 next tricks
     * @Route("/{start}", name="loadMoreTricks", requirements={"start": "\d+"})
     */
    public function loadMoreTricks(TricksRepository $repository, $start = 8)
    {
        // Get 15 tricks from the start position
        $tricks = $repository->findBy([], ['publishedAt' => 'DESC'], 8, $start);
        return $this->render('tricks/loadMoreTricks.html.twig', [
            'tricks' => $tricks
        ]);
    }

    /**
     * Display Single Page
     * @Route("/tricks/{slug}-{id}", name="tricks_single", requirements={"slug": "[a-z0-9\-]*" })
     */
    public function single(Tricks $tricks, string $slug, Request $request, CommentRepository $repository) :Response
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

        $comment = $repository->findBy(['tricks' => $tricks->getId()], ['publishedAt' => 'DESC'], 3, 0);

         return $this->render('tricks/single.html.twig', [
             'comment' => $comment,
             'tricks' => $tricks,
             'medias' => $medias,
             'commentForm' => $form->createView()
        ]);
    }


    /**
     * Get the 3 next Comment
     * @Route("/tricks/{tricks}/{start}", name="loadMoreComment", requirements={"start": "\d+"})
     */
    public function loadMoreComment(Tricks $tricks,CommentRepository $repository, $start = 3 )
    {
        $comment = $repository->findBy(['tricks' => $tricks->getId()], ['publishedAt' => 'DESC'], 3, $start);

        return $this->render('tricks/loadMoreComment.html.twig', [
            'comment' => $comment,
            'start' => $start
        ]);
    }
}
