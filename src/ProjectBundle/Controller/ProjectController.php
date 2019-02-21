<?php

namespace ProjectBundle\Controller;

use ProjectBundle\Entity\Project;
use ProjectBundle\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;


class ProjectController extends Controller
{

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function projectCreateAction(Request $request)
    {
        $project = new Project();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ProjectType::class,$project);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($project);
            $em->flush();
            $this->redirectToRoute('list_tasks');
        }
        return $this->render('@Project/Employer/post_project.html.twig',['form'=>$form->createView()]);

    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function projectsAction()
    {
        $projects= $this->getDoctrine()->getRepository(Project::class)->findAll();
        return $this->render('ProjectBundle:Employer:task.html.twig',["projects" => $projects]);

    }


















    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    public function detailsAction()
    {
        return $this->render('ProjectBundle:Freelancer:details.html.twig');
        //, array(
        //            // ...
        //        ));
    }
}
