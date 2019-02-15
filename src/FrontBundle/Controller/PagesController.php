<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    public function findFreelancerAction()
    {
        return $this->render('@Front/Employer/findFreelancer.html.twig');
    }


    public function browseAction()
    {
        return $this->render('@Front/Freelancer/browseCompanies.html.twig');
    }

    public function jobAction()
    {
        return $this->render('@Front/Freelancer/jobPage.html.twig');
    }

    public function taskAction()
    {
        return $this->render('@Front/Freelancer/taskPage.html.twig');
    }

    public function companyAction()
    {
        return $this->render('@Front/Freelancer/companyProfile.html.twig');
    }

    public function taskListAction()
    {
        return $this->render('@Front/Freelancer/tasksList.html.twig');
    }

    public function jobListAction()
    {
        return $this->render('@Front/Freelancer/jobsList.html.twig');
    }
}


