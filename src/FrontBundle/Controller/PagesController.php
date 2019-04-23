<?php

namespace FrontBundle\Controller;

use PortfolioBundle\Entity\Portfolio;
use ReviewBundle\Entity\Review;
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
        $review=$this->getDoctrine()->getRepository(Review::class)->findBy(['freelancerReviewedId'=>$freelancer]);
        $portfolio=$this->getDoctrine()->getRepository(Portfolio::class)->findOneBy(['freelancer'=>$freelancer]);
        return $this->render('@Front/Employer/freelancerProfile.html.twig', array("freelancer"=>$freelancer,'review'=>$review,'portfolio'=>$portfolio));
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


