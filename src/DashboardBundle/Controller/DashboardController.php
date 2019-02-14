<?php

namespace DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function freealancerDashboardAction()
    {
        return $this->render('DashboardBundle:Dashboard:freealancer_dashboard.html.twig', array(
            // ...
        ));
    }

    public function employerDashboardAction()
    {
        return $this->render('DashboardBundle:Dashboard:employer_dashboard.html.twig', array(
            // ...
        ));
    }

}
