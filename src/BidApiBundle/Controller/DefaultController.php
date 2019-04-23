<?php

namespace BidApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BidApiBundle:Default:index.html.twig');
    }
}
