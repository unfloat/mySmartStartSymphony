<?php

namespace JobBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class JobController extends Controller
{
    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function managecandidatesAction()
    {
        return $this->render('JobBundle:Employer:manage_candidates.html.twig', array(
            // ...
        ));
    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function manageJobsAction()
    {
        $job=$this->getDoctrine()->getRepository(job::class)->findAll();
        return $this->render('@Job/Employer/showJob.html.twig',array('job'=>$job));
    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */


    public function postJobAction(Request $request)
    {
        //$currentuser=$this->getUser();
        //$id=$currentuser->getId();
        $job = new Job();
        // $job->setEmployerId($id);

        $form = $this->createForm(JobType::class,$job);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();
            return $this->redirectToRoute('manage_jobs');
        }
        return $this->render('@Job/Employer/postJob.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */


    public function deleteJobAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $job=$em->getRepository(Job::class)->find($id);
        $em->remove($job);
        $em->flush();
        return $this->redirectToRoute('manage_jobs');
    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */


    public function editJobAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $job=$em->getRepository(Job::class)->find($id);
        $form = $this->createForm(JobType::class,$job);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();
            return $this->redirect($this->generateUrl('manage_jobs'));
        }
        return $this->render('@Job/Employer/postJob.html.twig',['form'=>$form->createView()]);
    }


    public function displayJobAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $job=$this->getDoctrine()->getRepository(job::class)->find($id);
        return $this->redirectToRoute('manage_jobs');

    }


}
