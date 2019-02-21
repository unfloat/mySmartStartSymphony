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
            return $this->redirectToRoute('list_manage_projects');
        }
        return $this->render('@Project/Employer/post_project.html.twig',['form'=>$form->createView()]);

    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function manage_projectsAction()
    {
        $manage_projects= $this->getDoctrine()->getRepository(Project::class)->findAll();
        return $this->render('@Project/Employer/manage_projects.html.twig',["manage_projects" => $manage_projects]);

    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function delete_manage_projectsAction(Project $manage_project)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($manage_project);
        $em->flush();
        return $this->redirectToRoute('list_manage_projects');
    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function update_manage_projectsAction(Project $manage_project)
    {

    }








    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    public function projectsAction()
    {
        $projects= $this->getDoctrine()->getRepository(Project::class)->findAll();
        return $this->render('@Project/Freelancer/tasks.html.twig',["projects" => $projects]);

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
