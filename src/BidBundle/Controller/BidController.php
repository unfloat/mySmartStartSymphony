<?php

namespace BidBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BidController extends Controller
{
    public function indexAction()
    {
        return $this->render('BidBundle:Bid:index.html.twig');
        //, array(
        //            // ...
        //        ));
    }

    public function updateAction()
    {
        return $this->render('BidBundle:Bid:update.html.twig', array(
            // ...
        ));
    }

}
