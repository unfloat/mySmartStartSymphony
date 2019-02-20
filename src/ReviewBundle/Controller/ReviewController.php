<?php

namespace ReviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class ReviewController extends Controller
{
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
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

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function rateFreelancerAction()
    {
        return $this->render('ReviewBundle:Review:rate_freelancer.html.twig', array(
            // ...
        ));
    }

}
