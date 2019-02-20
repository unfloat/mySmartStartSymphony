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
