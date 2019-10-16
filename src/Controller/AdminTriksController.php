<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Media;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TricksRepository;
use App\Entity\Tricks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Form\TricksType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_USER")
 */
class AdminTriksController extends AbstractController
{
    /**
     * @var TricksRepository
     */
    private $repository; 

    /**
     * @var ObjectManager
     */
    private $om;

    public function __construct(TricksRepository $repository, ObjectManager $om)
    {
        $this->repository = $repository;
        $this->om =$om;
    }

    /**
     * @Route("/admin", name="admin_tricks_index")
     */
    public function index()
    {
        $tricks = $this->repository->findAll();
        return $this->render('admin/index.html.twig', compact('tricks')  )   ;
    }

    /**
     * Create New tricks
     * @Route("/admin/tricks/create", name="admin_tricks_new")
     */
    public function new(Request $request, FileUploader $fileUploader, EntityManagerInterface $entityManager)
    {
        $tricks = new Tricks();
        $form = $this->createForm(TricksType::class, $tricks);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($tricks->getMedia() as $media) {
                $fileName = $fileUploader->upload($media->getFile() );

                $media->setPath($fileName);
                $media->setTricks($tricks);

                if ($media->getThumbnail() == True ){
                    $media->setThumbnail(True);
                }
                else{
                    $media->setThumbnail(False);
                }
                $entityManager->persist($media);
            }
            $user = $this->getUser() ;
            $tricks->setAuthor($user);

            foreach ($form->get('Embed')->getData() as  $embed) {
                $video = New Media();
                $video->setPath($embed->getEmbed());
                $video->setTricks($tricks);
                $video->setText('Embed');
                $entityManager->persist($video);
            }

            $entityManager->persist($tricks);
            $entityManager->flush();

            $this->addFlash('succes', 'Création réussi !');
            return $this->redirectToRoute('admin_tricks_index');
        }
        return $this->render('admin/tricksNew.html.twig', [
            'tricks' => $tricks,
            'form' => $form->createView()
        ]);
    }

    /**
     * Edit Tricks
     * @Route("/admin/tricks/{id}", name="admin_tricks_edit")
     */
    public function edit(Tricks $tricks,Request $request,FileUploader $fileUploader, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(TricksType::class, $tricks);
        $form->handleRequest($request);

        $medias = $tricks->getMedia(); // just View

        if ($form->isSubmitted() && $form->isValid()) {

            $trick = $form->getData();
            $trick->setAuthor($this->getUser());

            foreach ($medias as $media) {
                if(!$media->getId()) {
                    $fileName = $fileUploader->upload($media->getFile());
                    $media->setTricks($trick);
                    $media->setPath($fileName);
                    $media->setText($media->getText());
                    $entityManager->persist($media); // new
                    $entityManager->flush(); // new
                }
                if($media->getThumbnail() == true){
                    $this->select_thumbnail($media->getId(),$tricks);
                }
            }
            foreach ($form->get('Embed')->getData() as  $embed) {
                $video = New Media();
                $video->setPath($embed->getEmbed());
                $video->setTricks($tricks);
                $video->setText('Embed');
                $video->setThumbnail('0');
                $entityManager->persist($video);
            }
            $entityManager->persist($tricks);
            $entityManager->flush();

            $this->addFlash('succes', 'Modification réussi !');

            return $this->redirectToRoute('admin_tricks_index');
        }

        return $this->render('admin/tricksEdit.html.twig', [
            'tricks' => $tricks,
            'medias' => $medias,
            'form' => $form->createView()
        ]);
    }

    /**
     * Delete Tricks
     * @Route("/admin/tricks/delete/{id}", name="admin_tricks_delete", methods="DELETE")
     */
    public function delete(Tricks $tricks,Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $tricks->getId(), $request->get('_token') ) ) {

            $entityManager = $this->getDoctrine()->getManager();
            /* Delete Media */
            $MediaRepository = $this->getDoctrine()->getRepository(Media::class);
            $medias = $MediaRepository->findBy(array('tricks' => $tricks->getId()));
            foreach($medias as $media)
            {
                $entityManager->remove($media);
            }
            /* Delete Comment */
            $CommentRepository = $this->getDoctrine()->getRepository(Comment::class);
            $comments = $CommentRepository->findBy(array('tricks' => $tricks->getId()));
            foreach($comments as $comment)
            {
                $entityManager->remove($comment);
            }
            /* Delete Tricks */
            $repository = $this->getDoctrine()->getRepository(Tricks::class);
            $tricks = $repository->findOneBy(array('id' => $tricks->getId()));
            $entityManager->remove($tricks);
            $entityManager->flush();
        }
        $this->addFlash('succes','Tricks Supprimé');

      return $this->redirectToRoute('admin_tricks_index');
    }

    /**
     * Select thumbnail
     * @Route("select_thumbnail/{id}/{tricks}",name="select_thumbnail")
     */
    public function select_thumbnail($id,$tricks)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $TrickRepository = $this->getDoctrine()->getRepository(Tricks::class);
        $MediaRepository = $this->getDoctrine()->getRepository(Media::class);

        $tricks_id = $TrickRepository->findOneBy(array('id' => $tricks));
        $medias = $MediaRepository->findBy(array('tricks' => $tricks_id));

        foreach($medias as $media) {
            $media->setThumbnail(false);
            $entityManager->persist($media);
        }
        $media = $MediaRepository->findOneBy(array('id' => $id));
        $media->setThumbnail(true);
        $entityManager->persist($media);
        $entityManager->flush();

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }
}
