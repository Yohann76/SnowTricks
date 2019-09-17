<?php

namespace App\Controller;

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

                $entityManager->persist($media);
            }
            $user = $this->getUser() ; // Récupére l'utilisateur courant
            $tricks->setAuthor($user);

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
     * @Route("/admin/tricks/{id}", name="admin_tricks_edit")
     */
    public function edit(Tricks $tricks,Request $request,FileUploader $fileUploader, EntityManagerInterface $entityManager)
    {

        $form = $this->createForm(TricksType::class, $tricks); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $trick = $form->getData();
            $trick->setAuthor($this->getUser());

            foreach ($tricks->getMedia() as $i) {

                $media = New Media();
                $fileName = $fileUploader->upload($i->getFile() );

                $media->setPath($fileName);
                $media->setTricks($trick);

                $media->setText( $i->getText() );

                $entityManager->persist($media);
                $entityManager->flush();
            }

            $entityManager->persist($tricks);
            $entityManager->flush();

            $this->addFlash('succes', 'Modification réussi !');
            return $this->redirectToRoute('admin_tricks_index');
        }

        $medias = $tricks->getMedia(); // just View

        return $this->render('admin/tricksEdit.html.twig', [
            'tricks' => $tricks,
            'medias' => $medias,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/tricks/{id}", name="admin_tricks_delete", methods="DELETE")
     */
    public function delete(Tricks $tricks,Request $request)
    { 
        if($this->isCsrfTokenValid('delete'. $tricks->getId(), $request->get('_token') ) ) {
            $this->om->remove($tricks);
            $this->om->flush();
            $this->addFlash('succes', 'Suppression réussi !');
        }

      return $this->redirectToRoute('admin_tricks_index');
    }
}
