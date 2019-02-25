<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use UserBundle\Entity\Freelancer;
use UserBundle\Entity\User;


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
        $freelancers = $this->getDoctrine()->getRepository(Freelancer::class)->findAll();
        return $this->render('@Front/Employer/findFreelancer.html.twig', array("freelancers"=>$freelancers));
    }
    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function freelancerProfileAction(Freelancer $freelancer)
    {

        return $this->render('@Front/Employer/freelancerProfile.html.twig', array("freelancer"=>$freelancer));
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

    public function jobListAction()
    {
        return $this->render('@Front/Freelancer/jobList.html.twig');
    }

    public function jobPageAction()
    {
        return $this->render('@Front/Freelancer/jobPage.html.twig');
    }

















}


