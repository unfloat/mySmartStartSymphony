<?php

namespace ReviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReviewController extends Controller
{
    public function rateEmployerAction()
    {
        return $this->render('ReviewBundle:Review:rate_employer.html.twig', array(
            // ...
        ));
    }
    
/*
    public function AddReviewAction(Request $request)
    {
        $review = new Review();
        $form = $this->createForm(reviewType::class,$review);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();
            return $this->redirectToRoute('rate_freelancer');
        }
        return $this->render('ReviewBundle:Review:rate_employer.html.twig', ['form' => $form->createView()]);

    }
*/

    public function rateFreelancerAction()
    {
        return $this->render('ReviewBundle:Review:rate_freelancer.html.twig', array(
            // ...
        ));
    }

}
