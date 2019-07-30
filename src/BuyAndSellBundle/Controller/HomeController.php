<?php

namespace BuyAndSellBundle\Controller;

use BuyAndSellBundle\Entity\Ad;
use BuyAndSellBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="index")
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

    /**
     * @Route("/myposts", name="my_ads")
     */
    public function myPosts()
    {
        $ads = $this->getDoctrine()->getRepository(Ad::class)->findBy(['author' => $this->getUser()]);
    return $this->render('users/myPosts.html.twig',[
        'ads' => $ads
    ]);
    }

}
