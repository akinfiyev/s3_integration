<?php

namespace App\Controller;

use App\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function indexAction(Request $request)
    {
        $image = new Media();
        $image
            ->setContentType($request->headers->get('Content-Type'))
            ->setContent($request->getContent());

        $this->getDoctrine()->getManager()->persist($image);
        $this->getDoctrine()->getManager()->flush();

        return new Response();
    }

    /**
     * @Route("/", methods={"DELETE"})
     */
    public function removeAction()
    {
        $this->getDoctrine()->getManager()->remove($this->getDoctrine()->getRepository(Media::class)->find(3));
        $this->getDoctrine()->getManager()->flush();

        return new Response();
    }
}