<?php

namespace BidBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BidController extends Controller
{
    public function bidsAction()
    {
        return $this->render('BidBundle:Freelancer:active_bids.html.twig');
        //, array(
        //            // ...
        //        ));
    }

    public function manageBiddersAction()
    {
        return $this->render('BidBundle:Employer:manage_bidders.html.twig');
        //, array(
        //            // ...
        //        ));
    }



}
