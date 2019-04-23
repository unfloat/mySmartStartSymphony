<?php

namespace ProjectBundle\Controller;

use BidBundle\Entity\Bid;
use BidBundle\Form\BidType;
use BookmarkBundle\Entity\Bookmark;
use Doctrine\ORM\OptimisticLockException;
use ProjectBundle\Entity\Project;
use ProjectBundle\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\Employer;


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
            try {
                $project->setPublishingDate(new \DateTime('now'));
                $project->setEmployer($this->getUser());
                $em->persist($project);
                $em->flush();
                return $this->redirectToRoute('manage_projects');
            } catch (\Exception $e) {
            }

        }
        return $this->render('@Project/Employer/post_project.html.twig',['form'=>$form->createView()]);

    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function manage_projectsAction()
    {
        $count = [];
        $sum = 0;
        $deliveryTime = [];
        $projects= $this->getDoctrine()->getRepository(Project::class)->findBy(['employer'=>$this->getUser()]);

        foreach ($projects as $project)
        {
            $bids= $this->getDoctrine()->getRepository(Bid::class)->findBy(['project'=> $project->getId()]);
            $numberOfBids = count($bids);
            $count[$project->getId()]['numberOfBids'] = $numberOfBids;
            if($numberOfBids > 0){
                foreach ($bids as $bid)
                {
                    $sum = $sum + $bid->getMinimalRate();
                    $deliveryTime[$bid->getId()] = $bid->getDeliveryTime();

                }

                $count[$project->getId()]['average'] = $sum / $numberOfBids;
                $count[$project->getId()]['minDeliveryTime'] = min($deliveryTime);


            }
            else
            {
                $count[$project->getId()]['average'] = 0;
                $count[$project->getId()]['minDeliveryTime'] = 0;
            }
        }


        return $this->render('@Project/Employer/manage_projects.html.twig',["projects" => $projects,'count'=>$count]);

    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function manageprojectsAction(Request $request)
    {
        $manage_projects= $this->getDoctrine()->getRepository(Project::class)->findAll();

        $paginator= $this->get('knp_paginator');
        $result=$paginator->paginate(
            $manage_projects, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 4)/*limit per page*/
        );

        return $this->render('@Project/Employer/manage_projects.html.twig',["manage_projects" => $result]);
    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function delete_manage_projectsAction(Project $project)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($project);
        $em->flush();
        return $this->redirectToRoute('manage_projects');

    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function update_manage_projectsAction(Request $request,Project $manage_project)
    {
        $em=$this->getDoctrine()->getManager();
        $form=$this->createForm(ProjectType::class,$manage_project);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('manage_projects');
        }
        return $this->render('@Project/Employer/post_project.html.twig', ["form" => $form->createView()]);


    }



    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function projectsListAction()
    {
        $projects= $this->getDoctrine()->getRepository(Project::class)->findAll();
        return $this->render('ProjectBundle:Freelancer:taskslist.html.twig',["projects" => $projects]);

    }


    //hethi vue single task feha bid
    //bellehi mé tmessouhech
    // Fatma khalleha el vue to nkamalha ena
    //ken jetek mochkla fel pull aamel accept theirs aal fichier hetha bethet
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     * @param Request $request
     * @param Project $project
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function singleProjectAction(Request $request,Project $project)
    {
        $freelancer = $this->getUser();

        $bookmark = $this->getDoctrine()->getRepository(Bookmark::class)->findOneBy(['project' => $project,'freelancer' => $this->getUser()]);

        $em=$this->getDoctrine()->getManager();
        $bid = new Bid();
        $form=$this->createForm(BidType::class,$bid);
        $form->handleRequest($request);


        $freelancerBid = $this->getDoctrine()->getRepository(Bid::class)->findBy(['freelancer'=>$freelancer,'project'=>$project]);
        if ($freelancerBid)
        {
            $message = "You already placed a bid on this project :(";
            return $this->render('@Project/Freelancer/task.html.twig',['bookmark'=>$bookmark,"message" => $message,"project" => $project,"form" => $form->createView()]);
        }

        if($form->isSubmitted())
        {
            $bid->setFreelancer($freelancer);
            $bid->setProject($project);
            $em->persist($bid);
            $em->flush();


            try {
                $path = $this->getParameter(realpath);
                $manager = $this->get('mgilet.notification');
                $notif = $manager->createNotification('New Bid');
                $notif->setMessage($bid->getFreelancer()->getUsername().' bidded on your project '.$bid->getProject()->getProjectName() );
                $notif->setLink('/bid/bidders/'.$bid->getProject()->getId());
                $notifiedID = $bid->getProject()->getEmployer()->getId();
                $notified = $this->getDoctrine()->getRepository(Employer::class)->find($notifiedID);
                $manager->addNotification([$notified], $notif, true);


            } catch (OptimisticLockException $e) {
            }

        }

        return $this->render('@Project/Freelancer/task.html.twig',['bookmark'=>$bookmark,"project" => $project,"form" => $form->createView()]);

    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     * @param Project $project
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function bookMarkAction(Project $project)
    {
        $doc = $this->getDoctrine();
        $bookmarkExist = $doc->getRepository(Bookmark::class)->findOneBy(['project' => $project,'freelancer' => $this->getUser()]);


        if ($bookmarkExist){
            $em =$doc->getManager();
            $em->remove($bookmarkExist);
            $em->flush();
            return $this->redirectToRoute('project',['id'=>$project->getId()]);


        }else{
            try {
                $bookmark = new Bookmark();
                $bookmark->setFreelancer($this->getUser());
                $bookmark->setDateAdded(new \DateTime('now'));
                $bookmark->setProject($project);

                $em =$doc->getManager();
                $em->persist($bookmark);
                $em->flush();
                return $this->redirectToRoute('project',['id'=>$project->getId()]);

            } catch (\Exception $e) {
            }


        }


    }
}
