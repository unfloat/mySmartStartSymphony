<?php

namespace JobBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class JobController extends Controller
{
    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function manageJobsAction()
    {
        return $this->render('JobBundle:Employer:manage_jobs.html.twig', array(
            // ...
        ));
    }
    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function managecandidatesAction()
    {
        return $this->render('JobBundle:Employer:manage_candidates.html.twig', array(
            // ...
        ));
    }
    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function postJob()
    {
        return $this->render('JobBundle:Employer:postJob.html.twig', array(
            // ...
        ));
    }

}
