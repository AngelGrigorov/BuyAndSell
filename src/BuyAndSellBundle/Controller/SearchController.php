<?php
namespace BuyAndSellBundle\Controller;

use BuyAndSellBundle\Entity\Ad;
use Doctrine\ORM\AbstractQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $keyword = $request->request->get('keyword');
        $ads = $this->getDoctrine()->getRepository(Ad::class)
            ->createQueryBuilder('p')
            ->where("p.title LIKE '%$keyword%'")
            ->getQuery()
            ->getResult(AbstractQuery::HYDRATE_OBJECT);
        return $this->render(
            'ad/search.html.twig',
            [
                'ads' => $ads,
                'keyword' => $keyword,
            ]
        );
    }
}
