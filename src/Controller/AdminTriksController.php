<?php

namespace App\Controller;

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
    public function new(Request $request)
    {
        $tricks = new Tricks();

        $form = $this->createForm(TricksType::class, $tricks);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->om->persist($tricks);
            $this->om->flush();
            $this->addFlash('succes', 'Création réussi !');
            return $this->redirectToRoute('admin_tricks_index');
        }

        return $this->render('admin/tricksNew.html.twig', [
            'tricks' => $tricks,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/tricks/{id}", name="admin_tricks_edit", methods="GET|POST")
     */
    public function edit(Tricks $tricks, Request $request)
    {
        $form = $this->createForm(TricksType::class, $tricks); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->om->flush();
            $this->addFlash('succes', 'Modification réussi !');
            return $this->redirectToRoute('admin_tricks_index');

        }
        return $this->render('admin/tricksEdit.html.twig', [
            'tricks' => $tricks,
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
