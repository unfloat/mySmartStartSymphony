<?php

namespace ReportBundle\Controller;

use ReportBundle\Entity\Report;
use ReportBundle\Form\ReportType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReportController extends Controller
{
    public function addReportAction(Request $request )
    {
        $currentUser=$this->getUser();
        $report = new Report();
        $report->setEmployerReporterId($currentUser);
        $form = $this->createForm(ReportType::class,$report);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($report);
            $em->flush();
            return $this->redirectToRoute('employer_dashboard');
        }
        return $this->render('ReportBundle:Report:reportForm.html.twig', ['form' => $form->createView()]);

    }
}
