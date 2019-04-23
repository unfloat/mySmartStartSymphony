<?php

namespace DashboardBundle\Controller;

use Doctrine\ORM\OptimisticLockException;
use JobBundle\Entity\Job;
use NoteBundle\Entity\Note;
use PortfolioBundle\Entity\Portfolio;
use PortfolioBundle\Form\PortfolioType;
use ReviewBundle\Entity\Review;
use ReviewBundle\Entity\ReviewEmp;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;



class DashboardController extends Controller

{
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function freelancerDashboardAction(Request $request)
    {
        $user = $this->getUser();
        $reviews = $this->getDoctrine()->getRepository( Review::class)->findBy(['freelancerReviewedId'=>$this->getUser()]);
        $nombreReviews = count($reviews);
        $portfolio=$this->getDoctrine()->getRepository(Portfolio::class)->findOneBy(['freelancer' => $this->getUser()]);
        if(is_null($portfolio))
        {
            $portfolio = new Portfolio();
            $portfolio->setFreelancer($user);

            $form = $this->createForm(PortfolioType::class, $portfolio);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($portfolio);
                $em->flush();
                return $this->redirectToRoute('freelancer_dashboard');
            }
            return $this->render('@Portfolio\Freelancer\addPortfolio.html.twig', ['form' => $form->createView()]);}
        else{
            return $this->render('DashboardBundle:Freelancer:dashboard.html.twig',['nombreReviews'=>$nombreReviews,'freelancer'=>$user,'portfolio'=>$portfolio]);
        }

    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function employerDashboardAction()
    {
        $user = $this->getUser();
        $reviews = $this->getDoctrine()->getRepository( ReviewEmp::class)->findBy(['employerReviewedId'=>$this->getUser()]);
        $nombreReviews = count($reviews);
        $nbr_jobs=$this->getDoctrine()->getRepository(Job::class)->findBy(['employer'=>$this->getUser()]);
        $nbr=count($nbr_jobs);

        return $this->render('DashboardBundle:Employer:dashboard.html.twig',['nombreReviews'=>$nombreReviews,'employer'=>$user,'nbr_job'=>$nbr]);
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function newAction(Request $request)
    {
        //parameters from request
        $noteText = $request->get('note');
        $priorityText = $request->get('priority');

        //if fields empty
        if ($priorityText == '' && $noteText == '') {
            return new JsonResponse(["message" => 'Pirority and Note are required', "validate" => false]);
        }
        if ($priorityText == '') {
            return new JsonResponse(["message" => 'Priority is required', "validate" => false]);
        } else if ($noteText == '') {
            return new JsonResponse(["message" => 'Note is required', "validate" => false]);
        } else if ($request->isXmlHttpRequest()) {
            //fields filled and request made
            $note = new Note();
            $note->setNoteText($noteText);
            $note->setPriority($priorityText);


            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();

            $url = $this->generateUrl('freelancer_dashboard');

            return new JsonResponse(["message" => 'Note added :)', "validate" => true, "redirect" => $url]);
        }


    }
}
