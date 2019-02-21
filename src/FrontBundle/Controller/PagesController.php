<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class PagesController extends Controller
{
    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function employerHomeAction()
    {
        return $this->render('@Front/Employer/employerhome.html.twig');
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function freelancerHomeAction()
    {
        return $this->render('@Front/Freelancer/freelancerhome.html.twig');
    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function findFreelancerAction()
    {
        return $this->render('@Front/Employer/findFreelancer.html.twig');
    }


    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function browseAction()
    {
        return $this->render('@Front/Freelancer/browseCompanies.html.twig');
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function jobAction()
    {
        return $this->render('@Front/Freelancer/jobPage.html.twig');
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function taskAction()
    {
        return $this->render('@Front/Freelancer/taskPage.html.twig');
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    public function companyAction()
    {
        return $this->render('@Front/Freelancer/companyProfile.html.twig');
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    public function taskListAction()
    {
        return $this->render('@Front/Freelancer/tasksList.html.twig');
    }
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    public function jobListAction()
    {
        return $this->render('@Front/Freelancer/jobsList.html.twig');
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */


    public function freelancerProfileAction()
    {
        return $this->render('@Front/Employer/freelancerProfile.html.twig');
    }














}


