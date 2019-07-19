<?php

namespace FindYourCarBundle\Controller;

use FindYourCarBundle\Entity\Ad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="blog_index")
     *
     * @return Response
     */
    public function indexAction()
    {
        $ads = $this->getDoctrine()->getRepository(Ad::class)->findAll();

        return $this->render('default/index.html.twig', [
            'ads' => $ads
        ]);
    }

}
