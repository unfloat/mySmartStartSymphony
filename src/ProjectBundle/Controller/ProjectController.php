<?php

namespace ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectController extends Controller
{
    public function createProjectAction()
    {
        return $this->render('ProjectBundle:Employer:post_project.html.twig');
        //, array(
        //            // ...
        //        ));
    }

    public function projectsAction()
    {
        return $this->render('ProjectBundle:Employer:project.html.twig');
        //, array(
        //            // ...
        //        ));
    }
}
