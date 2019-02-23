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
        return $this->render('FrontBundle:Employer:home.html.twig');
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function freelancerHomeAction()
    {
        return $this->render('FrontBundle:Freelancer:home.html.twig');
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
    public function findCompanyAction()
    {
        return $this->render('@Front/Freelancer/browseCompanies.html.twig');
    }


    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    public function companyProfileAction($id)
    {
        return $this->render('@Front/Freelancer/companyProfile.html.twig');
    }
















}


