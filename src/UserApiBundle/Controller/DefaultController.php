<?php

namespace UserApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserApiBundle:Default:index.html.twig');
    }
}
