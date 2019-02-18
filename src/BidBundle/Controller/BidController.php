<?php

namespace BidBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BidController extends Controller
{
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function bidsAction()
    {
        //$this->denyAccessUnlessGranted('ROLE_EMPLOYER', null, 'Unable to access this page mthrfkn employer!');
        return $this->render('BidBundle:Freelancer:active_bids.html.twig');
    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function manageBiddersAction()
    {
        return $this->render('BidBundle:Employer:manage_bidders.html.twig');
        //, array(
        //            // ...
        //        ));
    }



}
