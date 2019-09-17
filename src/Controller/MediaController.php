<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Form\addTricksFormType;
use App\Service\Upload;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use App\Form\ArticleFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormView;

class MediaController extends AbstractController
{
    /**
     * @Route("image_delete/{id}", name="image_delete",)
     */
    public function image_delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        /* Delete Media */
        $MediaRepository = $this->getDoctrine()->getRepository(Media::class);
        $medias = $MediaRepository->findOneBy(array('id' => $id));
        $entityManager->remove($medias);
        $entityManager->flush();
        $this->addFlash('info','Image Supprimé');
        return $this->redirect($_SERVER['HTTP_REFERER']);

    }
}
