<?php

namespace JobBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JobController extends Controller
{
    public function manageJobsAction()
    {
        return $this->render('JobBundle:Employer:manage_jobs.html.twig', array(
            // ...
        ));
    }

    public function managecandidatesAction()
    {
        return $this->render('JobBundle:Employer:manage_candidates.html.twig', array(
            // ...
        ));
    }

    public function postJob()
    {
        return $this->render('JobBundle:Employer:postJob.html.twig', array(
            // ...
        ));
    }

}
