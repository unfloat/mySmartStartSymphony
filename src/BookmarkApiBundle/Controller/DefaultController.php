<?php

namespace BookmarkApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BookmarkApiBundle:Default:index.html.twig');
    }
}
