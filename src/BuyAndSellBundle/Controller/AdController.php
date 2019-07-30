<?php

namespace BuyAndSellBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use BuyAndSellBundle\Entity\Ad;
use BuyAndSellBundle\Entity\User;
use BuyAndSellBundle\Form\AdType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/ad/create", name="ad_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     * @throws \Exception
     */
    public function create(Request $request)
    {
        $ad = new Ad();
        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form['img']->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            if ($file) {
                $file->move(
                    $this->getParameter('ads_directory'),
                    $fileName
                );
                $ad->setImg($fileName);
            }
            $ad->setAuthor($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($ad);
            $em->flush();
            return $this->redirectToRoute('index');
        }

        return $this->render('ad/create.html.twig',
            array('form' => $form->createView()));
    }

    /**
     * @Route("/ad/{id}", name="ad_view")
     * @param $id
     * @return Response
     */
    public function viewAd($id)
    {
        $ad = $this->getDoctrine()->getRepository(Ad::class)->find($id);
        return $this->render('ad/ad.html.twig',
            ['ad' => $ad]);
    }

    /**
     * @Route("/ad/edit/{id}", name="ad_edit")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function editAd($id, Request $request)
    {
        $ad = $this->getDoctrine()->getRepository(Ad::class)->find($id);
        if ($ad === null) {
            return $this->redirectToRoute('index');
        }
        $currentUser = $this->getUser();
        /** @var User $currentUser */
        /** @var Ad $ad */
        if (!$currentUser->isAuthor($ad) && !$currentUser->isAdmin()) {
            return $this->redirectToRoute('index');
        }
        $form = $this->createForm(AdType::class, $ad);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            /** @var UploadedFile $file */
            $file = $form['img']->getData();
            if ($file->guessExtension() == null) {
                $form->remove('img');
            } else {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                if ($file) {
                    $file->move(
                        $this->getParameter('ads_directory'),
                        $fileName
                    );
                    $ad->setImg($fileName);

                }
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($ad);
            $em->flush();
            return $this->redirectToRoute('ad_view', array('id' => $ad->getId()));
        }
        return $this->render('ad/edit.html.twig',
            array('ad' => $ad,
                'form' => $form->createView(),
            ));
    }

    /**
     * @Route("/ad/delete/{id}", name="ad_delete")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function deleteAd($id, Request $request)
    {
        $ad = $this->getDoctrine()->getRepository(Ad::class)->find($id);
        if ($ad === null) {
            return $this->redirectToRoute('index');
        }
        $currentUser = $this->getUser();
        /** @var User $currentUser */
        /** @var Ad $ad */
        if (!$currentUser->isAuthor($ad) && !$currentUser->isAdmin()) {
            return $this->redirectToRoute('index');
        }
        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ad);
            $em->flush();
            return $this->redirectToRoute('index');
        }
        return $this->render('ad/delete.html.twig',
            array('ad' => $ad,
                'form' => $form->createView()));
    }
}
