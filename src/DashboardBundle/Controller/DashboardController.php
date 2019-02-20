<?php

namespace DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DashboardController extends Controller
{
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function freealancerDashboardAction()
    {
        return $this->render('DashboardBundle:Dashboard:freealancer_dashboard.html.twig', array(
            // ...
        ));
    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function employerDashboardAction()
    {
        return $this->render('DashboardBundle:Dashboard:employer_dashboard.html.twig', array(
            // ...
        ));
    }


}
