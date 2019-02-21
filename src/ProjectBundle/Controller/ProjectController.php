<?php

namespace ProjectBundle\Controller;

use BidBundle\Entity\Bid;
use BidBundle\Form\BidType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;


class ProjectController extends Controller
{
    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function createProjectAction()
    {
        return $this->render('ProjectBundle:Employer:post_project.html.twig');
        //, array(
        //            // ...
        //        ));
    }
    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function projectsAction()
    {
        return $this->render('ProjectBundle:Employer:project.html.twig');
        //, array(
        //            // ...
        //        ));
    }

    public function projectsListAction()
    {
        return $this->render('ProjectBundle:Freelancer:taskslist.html.twig');
        //, array(
        //            // ...
        //        ));
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    public function projectSingleAction(Request $request)
    {
        $bid = new Bid();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(BidType::class,$bid);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($bid);
            $em->flush();

        }
        return $this->render('ProjectBundle:Employer:post_project.html.twig',['form'=>$form->createView()]);

    }
}
