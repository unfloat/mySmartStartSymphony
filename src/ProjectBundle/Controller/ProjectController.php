<?php

namespace ProjectBundle\Controller;

use BidBundle\Entity\Bid;
use BidBundle\Form\BidType;
use BookmarkBundle\Entity\Bookmark;
use Doctrine\ORM\OptimisticLockException;
use OfferBundle\Entity\Category;
use OfferBundle\Entity\Skills;
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

    public function createProjectAction(Request $request)
    {
        $project = new Project();
        $project->setProjectStartDay(new \DateTime('now'));

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($project);
            $em->flush();
            return $this->redirectToRoute('employer_dashboard');
        }
        return $this->render('@Project/Employer/post_project.html.twig', ['form' => $form->createView()]);
    }


/*
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
*/

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function manage_projectsAction(Request $request)
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

        $paginator= $this->get('knp_paginator');
        $result=$paginator->paginate(
            $projects, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 4)/*limit per page*/
        );



        return $this->render('@Project/Employer/manage.html.twig',["manage_project" => $result,'count'=>$count]);

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

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function projectsAction(Request $request,$sortBy="projectName")
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $skills = $this->getDoctrine()->getRepository(Skills::class)->findAll();

        $projects= $this->getDoctrine()->getRepository(Project::class)->findBy(array(), array($sortBy=>'asc'));
        $paginator= $this->get('knp_paginator');
        $result=$paginator->paginate(
            $projects, /* query NOT result */
            $request->query->getInt('page', 1),4
        /*$request->query->getInt('limit', 4)/*limit per page*/
        );
        return $this->render('@Project/Freelancer/tasks.html.twig',array("projects"=>$result, "categories"=>$categories,"skills"=>$skills));

    }


    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function searchParametersAction(Request $request)
    {

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $skills = $this->getDoctrine()->getRepository(Skills::class)->findAll();
        $projects=$this->getDoctrine()->getRepository(Project::class)
            ->findParameters($request->get("location"),
                $request->get("categories"),
                $request->get("skills"),
                $request->get("sortBy"));

        $paginator= $this->get('knp_paginator');
        $result=$paginator->paginate(
            $projects, /* query NOT result */
            $request->query->getInt('page', 1),4
        /*$request->query->getInt('limit', 4)/*limit per page*/
        );
        return $this->render('@Project/Freelancer/tasks.html.twig',array("projects"=>$result, "categories"=>$categories,"skills"=>$skills));

    }

    public function mailAction($address){
        $message = (new \Swift_Message('Mail'))
            ->setFrom('foobar.esprit@gmail.com')
            ->setTo($address)
            ->setBody(
                $this->renderView(
                    '@Project/Freelancer/mail.html.twig', array(
                        'address'=>$address,
                    )
                ),
                'text/html'
            ) ;
        $this->get('mailer')->send($message);
        return new Response("Your email was sent successfully ");
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
            return $this->render('@Project/Freelancer/singletask.html.twig',['bookmark'=>$bookmark,"message" => $message,"project" => $project,"form" => $form->createView()]);
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
