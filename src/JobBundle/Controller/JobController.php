<?php

namespace JobBundle\Controller;

use JobBundle\Entity\Job;
use JobBundle\Form\JobType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;


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
        $job=$this->getDoctrine()->getRepository(Job::class)->findAll();
        return $this->render('@Job/Employer/showJob.html.twig',array('job'=>$job));
    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */


    public function postJobAction(Request $request)
    {
        $currentuser=$this->getUser();
        $job = new Job();
        $job->setEmployer($currentuser);

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
        $job=$this->getDoctrine()->getRepository(Job::class)->find($id);
        return $this->redirectToRoute('manage_jobs');

    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    public function jobListAction()
    {
        $jobs = $this->getDoctrine()->getRepository(Job::class)->findAll();
        return $this->render('@Job/Freelancer/jobsList.html.twig',['jobs'=>$jobs]);
    }

    /**
     * @Security("has_role('FROLE_FREELANCER')")
     * @param Job $job
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function jobPageAction(Job $job)
    {
        return $this->render('@Job/Freelancer/jobPage.html.twig',['job'=>$job]);
    }


}
