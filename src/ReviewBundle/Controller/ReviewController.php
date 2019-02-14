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

    public function rateFreelancerAction()
    {
        return $this->render('ReviewBundle:Review:rate_freelancer.html.twig', array(
            // ...
        ));
    }

}
