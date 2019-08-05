<?php

namespace BuyAndSellBundle\Controller;


use BuyAndSellBundle\Entity\Report;
use BuyAndSellBundle\Entity\User;
use BuyAndSellBundle\Form\ReportType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/report", name="report_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     * @throws \Exception
     */
    public function postReport(Request $request)
    {
        $report = new Report();
        $form = $this->createForm(ReportType::class, $report);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $report->setAuthor($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($report);
            $em->flush();
            return $this->redirectToRoute('index');
        }
        return $this->render('security/report.html.twig',
            array('form' => $form->createView()));
    }
    /**
     * @Route("/all_reports", name="all_reports")
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return Response
     */
    public function showAllReports()
    {
        $reports = $this->getDoctrine()->getRepository(Report::class)->findAll();
        $currentUser = $this->getUser();
        /** @var User $currentUser */
        if(!$currentUser->isAdmin()) {
            return $this->redirectToRoute('index');
        }
        return $this->render('admin/allReports.html.twig', [
            'reports' => $reports
        ]);
    }
    /**
     * @Route("/report/{id}", name="report_view")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @param $id
     * @return Response
     */
    public function viewReport($id)
    {
        $report = $this->getDoctrine()->getRepository(Report::class)->find($id);
        $currentUser = $this->getUser();
        /** @var User $currentUser */
        if(!$currentUser->isAdmin()) {
            return $this->redirectToRoute('index');
        }
        return $this->render('admin/report.html.twig',
            ['report' => $report]);
    }
    /**
     * @Route("/report/delete/{id}", name="report_delete")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function deleteReport($id, Request $request)
    {
        $report = $this->getDoctrine()->getRepository(Report::class)->find($id);
        if ($report === null) {
            return $this->redirectToRoute('all_reports');
        }
        $currentUser = $this->getUser();
        /** @var User $currentUser */
        /** @var Report $report */
        if ( !$currentUser->isAdmin()) {
            return $this->redirectToRoute('index');
        }
        $form = $this->createForm(ReportType::class, $report);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $em->remove($report);
            $em->flush();

            return $this->redirectToRoute('all_reports');
        }
        return $this->render('admin/deleteReport.html.twig',
            array('report' => $report,

                'form' => $form->createView()));
    }
}
